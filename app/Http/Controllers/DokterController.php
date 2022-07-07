<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
Use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Dokter $dokter)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Dokter"]
        ];

        if ($request->ajax()) {
            $data = $dokter->getData();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($data) {
                    return '<button type="button" class="btn btn-sm btn-icon" id="getEditDokter" data-id="'.$data->id.'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-body"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                        <a href="#" data-id="'.$data->id.'" class="btn btn-sm btn-icon" id="getDeleteDokter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-body"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('/erp/Dokter/index', [
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
    public function store(Request $request, Dokter $dokter)
    {
        $validator = \Validator::make($request->all(), [
            'nama'      => 'required',
            'spesialis' => 'required',
            'no_telp'   => 'required',
            'email'     => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'nama'          => $request->input('nama'),
            'spesialis'     => $request->input('spesialis'),
            'no_telp'       => $request->input('no_telp'),
            'email'         => $request->input('email'),
            'alamat'        => $request->input('alamat'),
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $dokter->storeData($data);
        $this->createUser($data, $request);

        return response()->json(['success'=>'Dokter berhasil ditambahkan']);
    }

    public function createUser(array $data, Request $request)
    {
        return User::create([
            'name'          => strtok($data['email'], '@'),
            'email'         => $data['email'],
            'password'      => Hash::make($request->input('password')),
            'created_by'    => $data['created_by'],
            'updated_by'    => $data['updated_by'],
            'level'         => 'dokter',
            'ip_address'    => $data['ip_address']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokter = new Dokter;
        $data = $dokter->findData($id);

        $html = '   <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Nama Dokter</label>
                        <input type="text" class="form-control dt-full-name" id="editnama" name="nama" value="'.$data->nama.'" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Spesialis</label>
                        <input type="text" class="form-control dt-full-name" id="editspesialis" name="spesialis" value="'.$data->spesialis.'" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Nomor Telpon</label>
                        <input type="text" class="form-control dt-full-name" id="editno_telp" name="no_telp" value="'.$data->no_telp.'" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Email</label>
                        <input type="text" class="form-control dt-full-name" id="editemail" name="email" value="'.$data->email.'" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                        <input type="text" class="form-control dt-full-name" id="editalamat" name="alamat" value="'.$data->alamat.'" />
                    </div>';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'nama'      => 'required',
            'spesialis' => 'required',
            'no_telp'   => 'required',
            'email'     => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'nama'          => $request->input('nama'),
            'spesialis'     => $request->input('spesialis'),
            'no_telp'       => $request->input('no_telp'),
            'email'         => $request->input('email'),
            'alamat'        => $request->input('alamat'),
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $dokter = new Dokter;
        $dokter->updateData($id, $data);

        return response()->json(['success'=>'Dokter berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete("DELETE dokter, users FROM dokter JOIN users ON dokter.email = users.email where dokter.id = ?", array($id));

        return response()->json(['success'=>'Dokter berhasil dihapus']);
    }
}
