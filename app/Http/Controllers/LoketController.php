<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Loket;
use App\Models\Poli;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class LoketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Loket $loket, Poli $poli)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Loket"]
        ];

        $poli = $poli->getData();

        if ($request->ajax()) {
            $data = $loket->getData();
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function($data) {
                    return '<button type="button" class="btn btn-sm btn-icon" id="getEditLoket" data-id="'.$data->id.'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 text-body"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                        <a href="#" data-id="'.$data->id.'" class="btn btn-sm btn-icon" id="getDeleteLoket"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash font-medium-2 text-body"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('/erp/loket/index', [
            'breadcrumbs' => $breadcrumbs,
            'poli' => $poli
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
    public function store(Request $request, Loket $loket)
    {
        $validator = \Validator::make($request->all(), [
            'nama' => 'required',
            'poli' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = array(
            'nama'          => $request->input('nama'),
            'id_poli'       => $request->input('poli'),
            'nomor'         => 0,
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $loket->storeData($data);

        return response()->json(['success'=>'Loket berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loket  $loket
     * @return \Illuminate\Http\Response
     */
    public function show(Loket $loket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loket  $loket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loket      = new Loket;
        $data       = $loket->findData($id);
        $poli       = new Poli;
        $poliklinik = $poli->getData();

        $html = '<div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                    <input type="text" class="form-control dt-full-name" id="editnama"
                        name="nama" value="'.$data->nama.'" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="poli">Poliklinik</label>
                    <select class="select2 form-select" name="poli" id="editpoli">';
                        foreach ($poliklinik as $p){
                            $html .= '<option value="'.$p->id.'"'.($data->id_poli == $p->id ? ' selected' : '').'>'.$p->nama.'</option>';
                        }
        $html .= '  </select>
                </div>';

        return response()->json(['html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loket  $loket
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
            'id_poli'       => $request->input('poli'),
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $loket = new Loket;
        $loket->updateData($id, $data);

        return response()->json(['success'=>'Loket berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loket  $loket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loket = new Loket;
        $loket->deleteData($id);

        return response()->json(['success'=>'Loket berhasil dihapus']);
    }
}
