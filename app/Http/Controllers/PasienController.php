<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
Use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pasien $pasien)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Pasien"]
        ];

        if ($request->ajax()) {
            $data = $pasien->getData();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($data) {
                    return '<button type="button" class="btn btn-sm btn-icon" id="getEditPasien" data-id="'.$data->id.'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-body"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                        <a href="#" data-id="'.$data->id.'" class="btn btn-sm btn-icon" id="getDeletePasien"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-body"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('/erp/Pasien/index', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pasien $pasien)
    {
        $validator = \Validator::make($request->all(), [
            'nama'          => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required',
            'umur'          => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'nama_ortu'     => 'required',
            'no_telp'       => 'required',
            'no_ktp'        => 'required',
            'nama_pengguna' => 'required',
            'password'      => 'required',
            'email'         => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
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
            'no_ktp'        => $request->input('no_ktp'),
            'email'         => $request->input('email'),
            'nama_pengguna' => $request->input('nama_pengguna'),
            'password'      => $request->input('password'),
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $pasien->storeData($data);
        $this->createUser($data);

        return response()->json(['success'=>'Pasien berhasil ditambahkan']);
    }

    public function createUser(array $data)
    {
        return User::create([
            'name'          => $data['nama_pengguna'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'created_by'    => $data['created_by'],
            'updated_by'    => $data['updated_by'],
            'level'         => 'pasien',
            'ip_address'    => $data['ip_address']
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show(Pasien $pasien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasien = new Pasien;
        $data = $pasien->findData($id);

        $html = '   <div class="mb-1">
                        <label class="form-label" for="no_ktp"><font style="color: red">*</font> No. KTP</label>
                        <input class="form-control" id="no_ktp" type="text" name="no_ktp" aria-describedby="no_ktp" autofocus="" tabindex="1" value="'.$data->no_ktp.'" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="nama"><font style="color: red">*</font> Nama</label>
                        <input class="form-control" id="nama" type="text" name="nama"
                            placeholder="John Doe" aria-describedby="nama" autofocus="" tabindex="1" required value="'.$data->nama.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="tempat_lahir"><font style="color: red">*</font> Tempat Lahir</label>
                        <input class="form-control" id="tempat_lahir" type="text" name="tempat_lahir" aria-describedby="tempat_lahir" autofocus="" tabindex="1" required value="'.$data->tempat_lahir.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="tgl_lahir"><font style="color: red">*</font> Tanggal Lahir</label>
                        <input class="form-control" id="tgl_lahir" type="date" name="tgl_lahir" aria-describedby="tgl_lahir" autofocus="" tabindex="1" required value="'.$data->tgl_lahir.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="umur">Umur</label>
                        <input class="form-control" id="umur" type="number" name="umur" aria-describedby="umur" autofocus="" tabindex="1" value="'.$data->umur.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="jenis_kelamin"><font style="color: red">*</font> Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="Laki-laki"'.($data->aktif == "Laki-laki" ? ' selected' : '').'>Laki-laki</option>
                            <option value="Perempuan"'.($data->aktif == "Perempuan" ? ' selected' : '').'>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="alamat">Alamat</label>
                        <input class="form-control" id="alamat" type="text" name="alamat" aria-describedby="alamat" autofocus="" tabindex="1" value="'.$data->alamat.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="pekerjaan">Pekerjaan</label>
                        <input class="form-control" id="pekerjaan" type="text" name="pekerjaan" aria-describedby="pekerjaan" autofocus="" tabindex="1" value="'.$data->pekerjaan.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="nama_ortu"><font style="color: red">*</font> Nama Orangtua</label>
                        <input class="form-control" id="nama_ortu" type="text" name="nama_ortu" aria-describedby="nama_ortu" autofocus="" tabindex="1" required value="'.$data->nama_ortu.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="no_telp"><font style="color: red">*</font> Nomor Hp/Telepon</label>
                        <input class="form-control" id="no_telp" type="text" name="no_telp" aria-describedby="no_telp" autofocus="" tabindex="1" required value="'.$data->no_telp.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="keterangan">Keterangan</label>
                        <input class="form-control" id="keterangan" type="text" name="keterangan" aria-describedby="keterangan" autofocus="" tabindex="1" value="'.$data->keterangan.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="username"><font style="color: red">*</font> Nama Pengguna</label>
                        <input class="form-control" id="username" type="text" name="username"
                            placeholder="johndoe" aria-describedby="username" autofocus="" tabindex="1" required value="'.$data->username.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="email"><font style="color: red">*</font> Email</label>
                        <input class="form-control" id="email" type="text" name="email"
                            placeholder="john@example.com" aria-describedby="email" tabindex="2" required value="'.$data->email.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="password"><font style="color: red">*</font> Kata Sandi</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" id="password" type="password"
                                name="password" placeholder="············" aria-describedby="password"
                                tabindex="3" required value="'.$data->password.'" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'nama'          => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required',
            'umur'          => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'nama_ortu'     => 'required',
            'no_telp'       => 'required',
            'no_ktp'        => 'required',
            'nama_pengguna' => 'required',
            'password'      => 'required',
            'email'         => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
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
            'no_ktp'        => $request->input('no_ktp'),
            'nama_pengguna' => $request->input('nama_pengguna'),
            'password'      => $request->input('password'),
            'email'         => $request->input('email'),
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $pasien = new Pasien;
        $pasien->updateData($id, $data);

        return response()->json(['success'=>'Pasien berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete("DELETE pasien, users FROM pasien JOIN users ON pasien.nama_pengguna = users.name where pasien.id = ?", array($id));

        return response()->json(['success'=>'Pasien berhasil dihapus']);
    }
}
