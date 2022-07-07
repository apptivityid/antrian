<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\GrupPerusahaan;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class GrupPerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GrupPerusahaan $grupPerusahaan)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Grup Perusahaan"]
        ];

        if ($request->ajax()) {
            $data = $grupPerusahaan->getData();
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($data) {
                    return '<button type="button" class="btn btn-sm btn-icon" id="getEditGrupPerusahaan" data-id="'.$data->kode.'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-body"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                        <a href="#" data-id="'.$data->kode.'" class="btn btn-sm btn-icon" id="getDeleteGrupPerusahaan"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-body"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('/erp/master/grupperusahaan/index', [
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
    public function store(Request $request, GrupPerusahaan $grupPerusahaan)
    {
        $validator = \Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'kode'          => $request->input('kode'),
            'nama'          => $request->input('nama'),
            'telp'          => $request->input('telp'),
            'email'         => $request->input('email'),
            'fax'           => $request->input('fax'),
            'alamat'        => $request->input('alamat'),
            'aktif'         => $request->input('aktif'),
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name
        );

        $grupPerusahaan->storeData($data);

        return response()->json(['success'=>'Grup Perusahaan berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GrupPerusahaan  $grupPerusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(GrupPerusahaan $grupPerusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GrupPerusahaan  $grupPerusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupPerusahaan = new GrupPerusahaan;
        $data = $grupPerusahaan->findData($id);

        $html = '<div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Kode</label>
                    <input type="text" class="form-control dt-full-name" id="editkode"
                        name="kode" value="'.$data->kode.'" readonly />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                    <input type="text" class="form-control dt-full-name" id="editnama"
                        name="nama" value="'.$data->nama.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Telepon</label>
                    <input type="text" class="form-control dt-full-name" id="edittelp"
                        name="telp" value="'.$data->telp.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Email</label>
                    <input type="text" class="form-control dt-full-name" id="editemail"
                        name="email" value="'.$data->email.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Fax</label>
                    <input type="text" class="form-control dt-full-name" id="editfax"
                        name="fax" value="'.$data->fax.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                    <input type="text" class="form-control dt-full-name" id="editalamat"
                        name="alamat" value="'.$data->alamat.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="country">Aktif</label>
                    <select class="select2 form-select" name="aktif" id="editaktif">
                        <option value="Y"'.($data->aktif == "Y" ? ' selected' : '').'>Ya</option>
                        <option value="T"'.($data->aktif == "T" ? ' selected' : '').'>Tidak</option>
                    </select>
                </div>';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GrupPerusahaan  $grupPerusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'kode' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'nama'          => $request->input('nama'),
            'telp'          => $request->input('telp'),
            'email'         => $request->input('email'),
            'fax'           => $request->input('fax'),
            'alamat'        => $request->input('alamat'),
            'aktif'         => $request->input('aktif'),
            'updated_by'    => Auth::user()->name
        );

        $grupPerusahaan = new GrupPerusahaan;
        $grupPerusahaan->updateData($id, $data);

        return response()->json(['success'=>'Grup Perusahaan berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrupPerusahaan  $grupPerusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupPerusahaan = new GrupPerusahaan;
        $grupPerusahaan->deleteData($id);

        return response()->json(['success'=>'Grup Perusahaan berhasil dihapus']);
    }
}
