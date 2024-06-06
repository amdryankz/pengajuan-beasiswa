<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'npm' => ['required', 'numeric'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->active_status !== 'Aktif' || $user->graduate_status !== 'Belum Lulus') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Account is not active');
                return redirect('/login');
            }

            $request->session()->regenerate();
            return redirect('/mhs/beranda');
        } else {
            $localUser = User::where('npm', $credentials['npm'])->first();
            if ($localUser) {
                Session::flash('status', 'failed');
                Session::flash('message', 'Invalid credentials');
                return redirect('/login');
            }

            $url = env('WEBSERVICE_URL');
            $key = env('WEBSERVICE_KEY');
            $client = new Client();
            $response = $client->request('GET', $url . $credentials['npm'] . $key);
            $body = $response->getBody()->getContents();
            $xml = simplexml_load_string($body);

            if ($xml->npm == $credentials['npm']) {
                $activeStatus = (string)$xml->status_aktif;
                $graduateStatus = (string)$xml->status_lulus;

                if ($activeStatus == 'Aktif' && $graduateStatus == 'Belum Lulus') {
                    $user = new User();
                    $user->npm = (string)$xml->npm;
                    $user->password = bcrypt('password');
                    $user->name = (string)$xml->nama;
                    $user->major = (string)$xml->prodi;
                    $user->faculty = (string)$xml->fakultas;
                    $user->gender = (string)$xml->jenis_kelamin;
                    $user->ipk = (float)$xml->ipk;
                    $user->total_sks = (int)$xml->sksLulus;
                    $user->active_status = $activeStatus;
                    $user->graduate_status = $graduateStatus;
                    $user->birthdate = date('Y-m-d', strtotime((string)$xml->tanggal_lahir));
                    $user->birthplace = (string)$xml->tempat_lahir;
                    $user->address = (string)$xml->alamat;
                    $user->email = (string)$xml->email;
                    $user->parent_name = (string)$xml->nama_ortu;
                    $user->phone_number = (string)$xml->no_tlp_mhs;
                    $user->save();

                    Auth::login($user);

                    $request->session()->regenerate();
                    return redirect('/mhs/beranda');
                } else {
                    Session::flash('status', 'failed');
                    Session::flash('message', 'Account is not active');
                    return redirect('/login');
                }
            } else {
                Session::flash('status', 'failed');
                Session::flash('message', 'User not found');
                return redirect('/login');
            }
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
