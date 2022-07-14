<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Poli $poli)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Poliklinik"]
        ];

        if ($request->ajax()) {
            $data = $poli->getData();
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($data) {
                    return '<button type="button" class="btn btn-sm btn-icon" id="getEditPoli" data-id="'.$data->id.'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-body"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                        <a href="#" data-id="'.$data->id.'" class="btn btn-sm btn-icon" id="getDeletePoli"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-body"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('/erp/Poli/index', [
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
    public function store(Request $request, Poli $poli)
    {
        $validator = \Validator::make($request->all(), [
            'nama' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'nama'          => $request->input('nama'),
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $poli->storeData($data);

        return response()->json(['success'=>'Poli berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function show(Poli $poli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poli = new Poli;
        $data = $poli->findData($id);

        $html = '<div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                    <input type="text" class="form-control dt-full-name" id="editnama"
                        name="nama" value="'.$data->nama.'" />
                </div>';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'nama' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'nama'          => $request->input('nama'),
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $poli = new Poli;
        $poli->updateData($id, $data);

        return response()->json(['success'=>'Poli berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poli = new Poli;
        $poli->deleteData($id);

        return response()->json(['success'=>'Poli berhasil dihapus']);
    }
}
