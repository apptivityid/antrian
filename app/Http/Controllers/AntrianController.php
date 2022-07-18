<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Poli;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Antrian $antrian)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Antrian"]
        ];

        if ($request->ajax()) {
            $data = $antrian->getData();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('/erp/Antrian/index', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function pasien(Request $request, Antrian $antrian, Poli $poli)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Antrian"]
        ];

        $poliklinik = $poli->getData();

        if ($request->ajax()) {
            $data = $antrian->getData();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('/erp/antrian/pasien', [
            'breadcrumbs' => $breadcrumbs,
            'poliklinik'  => $poliklinik
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
    public function store(Request $request, Antrian $antrian)
    {
        $validator = \Validator::make($request->all(), [
            'id_poliklinik' => 'required',
            'tanggal'       => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $pasien = $antrian->getDataPasien(Auth::user()->name);
        $nomor = DB::table('antrian')
                    ->select(DB::raw('MAX(no_antrian) AS no_antrian'))
                    ->where([
                        ['id_poliklinik', '=', $request->input('id_poliklinik')],
                        ['tanggal', '=', $request->input('tanggal')]
                     ])
                    ->first();
        $n = $nomor->no_antrian;

        $data = array(
            'id_pasien'     => $pasien->id_pasien,
            'tanggal'       => $request->input('tanggal'),
            'id_poliklinik' => $request->input('id_poliklinik'),
            'no_antrian'    => $n + 1,
            'created_by'    => Auth::user()->name,
            'updated_by'    => Auth::user()->name,
            'ip_address'    => $request->ip()
        );

        $antrian->storeData($data);

        return response()->json(['success'=>'Berhasil mendaftar']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function show(Antrian $antrian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
