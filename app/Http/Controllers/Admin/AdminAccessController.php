<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AdminAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Admin::all();

        return view('admin.access.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Admin::findOrFail($id);
        $user->delete();

        return redirect('/adm/akses')->with('status', 'success')->with('message', 'User deleted successfully');
    }
}
