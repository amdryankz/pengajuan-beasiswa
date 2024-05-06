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
            $request->session()->regenerate();
            return redirect('/mhs/beranda');
        } else {
            // Cek apakah user ada di web service
            $url = env('WEBSERVICE_URL');
            $key = env('WEBSERVICE_KEY');
            $client = new Client();
            $response = $client->request('GET', $url . $credentials['npm'] . $key);
            $body = $response->getBody()->getContents();
            $xml = simplexml_load_string($body);

            // Jika user ditemukan di web service, tambahkan ke dalam tabel users
            if ($xml->npm == $credentials['npm']) {
                $user = new User();
                $user->npm = (string)$xml->npm;
                $user->password = Hash::make($credentials['password']); // Jangan lupa hash password
                $user->name = (string)$xml->nama;
                $user->major = (string)$xml->prodi;
                $user->faculty = (string)$xml->fakultas;
                $user->gender = (string)$xml->jenis_kelamin;
                $user->ipk = (float)$xml->ipk;
                $user->total_sks = (int)$xml->sksLulus;
                $user->active_status = (string)$xml->status_aktif;
                $user->graduate_status = (string)$xml->status_lulus;
                $user->birthdate = date('Y-m-d', strtotime((string)$xml->tanggal_lahir));
                $user->birthplace = (string)$xml->tempat_lahir;
                $user->address = (string)$xml->alamat;
                $user->email = (string)$xml->email;
                $user->parent_name = (string)$xml->nama_ortu;
                $user->phone_number = (string)$xml->no_tlp_mhs;
                $user->save();

                // Autentikasi user yang baru ditambahkan
                Auth::login($user);

                $request->session()->regenerate();
                return redirect('/mhs/beranda');
            } else {
                // Jika user tidak ditemukan di web service, tampilkan pesan user not found
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
