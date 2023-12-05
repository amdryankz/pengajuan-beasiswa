<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'nip' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            if (Auth::guard('admin')->user()->status != 'Aktif') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('status', 'failed');
                Session::flash('message', 'Your account is not active');

                return redirect('/adm');
            }

            $request->session()->regenerate();

            return redirect('/adm/beranda');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Login Invalid');

        return redirect('/adm');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/adm');
    }

    public function index()
    {
        $data = Admin::all();

        return view('admin.access.index')->with('data', $data);
    }

    public function create()
    {
        $roles = Role::all();
        $disabledOptions = [];

        foreach ($roles as $role) {
            $adminCount = Admin::where('role_id', $role->id)->count();
            $disabledOptions[$role->id] = $adminCount > 0 && $role->name !== 'Admin';
        }

        return view('admin.access.create')->with('roles', $roles)->with('disabledOptions', $disabledOptions);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nip' => ['required'],
            'name' => ['required'],
            'password' => ['required'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        $data['password'] = bcrypt($data['password']);
        Admin::create($data);

        return redirect('/adm/akses')->with('status', 'success')->with('message', 'User created successfully');
    }

    public function edit($id)
    {
        try {
            $user = Admin::where('slug', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $user = Admin::findOrFail($id);
        }
        $roles = Role::all();

        $disabledOptions = [];

        foreach ($roles as $role) {
            $adminCount = Admin::where('role_id', $role->id)->count();
            $disabledOptions[$role->id] = $adminCount > 0 && $role->name !== 'Admin' && $role->id !== $user->role_id;
        }

        return view('admin.access.edit')->with('user', $user)->with('roles', $roles)->with('disabledOptions', $disabledOptions);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nip' => ['required'],
            'name' => ['required'],
            'status' => ['required'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        if ($data['status'] !== 'Aktif') {
            $data['role_id'] = null;
        }

        Admin::where('id', $id)->update($data);

        return redirect('/adm/akses')->with('status', 'success')->with('message', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = Admin::findOrFail($id);
        $user->delete();

        return redirect('/adm/akses')->with('status', 'success')->with('message', 'User deleted successfully');
    }
}
