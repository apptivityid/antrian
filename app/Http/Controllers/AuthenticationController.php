<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\Models\User;
Use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthenticationController extends Controller
{
    // Login basic
    public function login_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-login-basic', ['pageConfigs' => $pageConfigs]);
    }

    // Login Cover
    public function login_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-login-cover', ['pageConfigs' => $pageConfigs]);
    }

    // Register basic
    public function register_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-register-basic', ['pageConfigs' => $pageConfigs]);
    }

    // Register cover
    public function register_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-register-cover', ['pageConfigs' => $pageConfigs]);
    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $login_type = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL ) ? 'email' : 'name';

        $request->merge([
            $login_type => $request->input('username')
        ]);

        if (Auth::attempt($request->only($login_type, 'password'))) {
            return redirect()->intended('dashboard');
        }

        return redirect()->back()
            ->withInput()
            ->withErrors([
                'username' => 'Nama pengguna, email atau kata sandi salah.'
            ]);
    }

    public function postRegistration(Request $request)
    {
        request()->validate([
            'username' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ]);

        $data = array(
            'no_ktp'        => $request->input('no_ktp'),
            'nama'          => $request->input('nama'),
            'tempat_lahir'  => $request->input('tempat_lahir'),
            'tgl_lahir'     => $request->input('tgl_lahir'),
            'umur'          => $request->input('umur'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat'        => $request->input('alamat'),
            'pekerjaan'     => $request->input('pekerjaan'),
            'nama_ortu'     => $request->input('nama_ortu'),
            'no_telp'       => $request->input('no_telp'),
            'keterangan'    => $request->input('keterangan'),
            'name'          => $request->input('username'),
            'email'         => $request->input('email'),
            'password'      => $request->input('password'),
            'ip_address'    => $request->ip()
        );

        $check = $this->create($data);
        $check2 = $this->create_pasien($data);

        return Redirect::to("/")->withSuccess('Berhasil mendaftar');
    }

    public function create(array $data)
    {
        return User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'created_by'    => $data['name'],
            'updated_by'    => $data['name'],
            'level'         => 'pasien',
            'ip_address'    => $data['ip_address']
        ]);
    }

    public function create_pasien(array $data)
    {
        return Pasien::create([
            'no_ktp'        => $data['no_ktp'],
            'nama'          => $data['nama'],
            'tempat_lahir'  => $data['tempat_lahir'],
            'tgl_lahir'     => $data['tgl_lahir'],
            'umur'          => $data['umur'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat'        => $data['alamat'],
            'pekerjaan'     => $data['pekerjaan'],
            'nama_ortu'     => $data['nama_ortu'],
            'no_telp'       => $data['no_telp'],
            'keterangan'    => $data['keterangan'],
            'nama_pengguna' => $data['name'],
            'email'         => $data['email'],
            'created_by'    => $data['name'],
            'updated_by'    => $data['name'],
            'ip_address'    => $data['ip_address']
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }

    // Forgot Password basic
    public function forgot_password_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-forgot-password-basic', ['pageConfigs' => $pageConfigs]);
    }

    // Forgot Password cover
    public function forgot_password_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-forgot-password-cover', ['pageConfigs' => $pageConfigs]);
    }

    // Reset Password basic
    public function reset_password_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-reset-password-basic', ['pageConfigs' => $pageConfigs]);
    }

    // Reset Password cover
    public function reset_password_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-reset-password-cover', ['pageConfigs' => $pageConfigs]);
    }

    // email verify basic
    public function verify_email_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-verify-email-basic', ['pageConfigs' => $pageConfigs]);
    }

    // email verify cover
    public function verify_email_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-verify-email-cover', ['pageConfigs' => $pageConfigs]);
    }

    // two steps basic
    public function two_steps_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-two-steps-basic', ['pageConfigs' => $pageConfigs]);
    }

    // two steps cover
    public function two_steps_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-two-steps-cover', ['pageConfigs' => $pageConfigs]);
    }

    // register multi steps
    public function register_multi_steps()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-register-multisteps', ['pageConfigs' => $pageConfigs]);
    }
}
