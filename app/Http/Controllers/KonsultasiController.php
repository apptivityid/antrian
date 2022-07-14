<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use App\Models\Pasien;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Konsultasi $konsultasi)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Konsultasi"]
        ];

        $pasien = $konsultasi->getDataPasien();

        if ($request->ajax()) {
            $data = $konsultasi->getData();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($data) {
                    return '<button type="button" class="btn btn-sm btn-icon" id="getEditKonsultasi" data-id="'.$data->id.'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-body"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                        <a href="#" data-id="'.$data->id.'" class="btn btn-sm btn-icon" id="getDeleteKonsultasi"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-body"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                        <a href="#" data-id="'.$data->id.'" class="btn btn-sm btn-icon" id="getViewKonsultasi"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('/erp/Konsultasi/index', [
            'breadcrumbs' => $breadcrumbs,
            'pasien'      => $pasien
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
    public function store(Request $request, Konsultasi $konsultasi)
    {
        $validator = \Validator::make($request->all(), [
            'id_pasien'     => 'required',
            'tanggal'       => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'id_pasien'     => $request->input('id_pasien'),
            'tanggal'       => $request->input('tanggal'),
            'keterangan'    => $request->input('keterangan'),
            'resep'         => $request->input('resep'),
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $konsultasi->storeData($data);

        return response()->json(['success'=>'Konsultasi berhasil ditambahkan']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Konsultasi  $konsultasi
     * @return \Illuminate\Http\Response
     */
    public function show(Konsultasi $konsultasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Konsultasi  $konsultasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $konsultasi = new Konsultasi;
        $data = $konsultasi->findData($id);
        $data2 = $konsultasi->viewData($id);

        $html = '   <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Pasien</label>
                        <input class="form-control" id="editid_pasien" type="text" name="id_pasien" aria-describedby="pasien" autofocus="" tabindex="1" required readonly value="'.$data->id_pasien.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="tanggal"><font style="color: red">*</font> Tanggal Berobat</label>
                        <input class="form-control" id="edittanggal" type="date" name="tanggal" aria-describedby="tanggal" autofocus="" tabindex="1" required value="'.$data->tanggal.'" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="keterangan">Konsultasi</label>
                        <textarea class="form-control" name="keterangan" id="editketerangan" cols="30" rows="10">'.$data->keterangan.'</textarea>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="resep">Resep</label>
                        <textarea class="form-control" name="resep" id="editresep" cols="30" rows="10">'.$data->resep.'</textarea>
                    </div>';

        $html2 = '   <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">No. KTP:</label> '.$data2->no_ktp.'
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Nama Pasien:</label> '.$data2->nama.'
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="tanggal">Tanggal Berobat</label>: '.date('d-m-Y', strtotime($data->tanggal)).'
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="keterangan">Konsultasi</label>
                        <textarea class="form-control" name="keterangan" id="editketerangan" cols="30" rows="10" readonly>'.$data->keterangan.'</textarea>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="resep">Resep</label>
                        <textarea class="form-control" name="resep" id="editresep" cols="30" rows="10" readonly>'.$data->resep.'</textarea>
                    </div>';

        return response()->json(['html'=>$html, 'html2'=>$html2]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Konsultasi  $konsultasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'id_pasien' => 'required',
            'tanggal'   => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'id_pasien'     => $request->input('id_pasien'),
            'tanggal'       => $request->input('tanggal'),
            'keterangan'    => $request->input('keterangan'),
            'resep'         => $request->input('resep'),
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $konsultasi = new Konsultasi;
        $konsultasi->updateData($id, $data);

        return response()->json(['success'=>'Konsultasi berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Konsultasi  $konsultasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $konsultasi = new Konsultasi;
        $konsultasi->deleteData($id);

        return response()->json(['success'=>'Konsultasi berhasil dihapus']);
    }
}
