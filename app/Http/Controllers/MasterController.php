<?php

namespace App\Http\Controllers;
use App\Models\Master\Grup as GrupPerusahaan;
use App\Models\Master\GrupCoa as GrupCoa;
use App\Models\Master\Coa as Coa;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Datatable Basic
    public function grup()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Grup Perusahaan"], ['name' => "Advanced"]
        ];
        
        $datas = GrupPerusahaan::orderByDesc('nomor')->get();
        return view('/erp/master/grupperusahaan/index', [
            'breadcrumbs' => $breadcrumbs,
            'datas' => $datas
        ]);
    }

    public function grupcoa()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Grup COA"], ['name' => "Advanced"]
        ];
        
        $datas = GrupCoa::orderByDesc('nomor')->get();
        return view('/erp/master/grupcoa/index', [
            'breadcrumbs' => $breadcrumbs,
            'datas' => $datas
        ]);
    }

    public function lokasi()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Lokasi"], ['name' => "Advanced"]
        ];
        $datas = Coa::orderByDesc('nomor')->get();
        $grupcoas = GrupCoa::orderByDesc('nomor')->get();
        return view('/erp/master/lokasi/index', [
            'breadcrumbs' => $breadcrumbs,
            'datas' => $datas,
            'grupcoas' => $grupcoas
        ]);
    }

    public function coa()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "COA"], ['name' => "Advanced"]
        ];
        $datas = Coa::orderByDesc('nomor')->get();
        $grupcoas = GrupCoa::orderByDesc('nomor')->get();
        return view('/erp/master/coa/index', [
            'breadcrumbs' => $breadcrumbs,
            'datas' => $datas,
            'grupcoas' => $grupcoas
        ]);
    }

    public function perusahaan()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Perusahaan"], ['name' => "Advanced"]
        ];
        $perusahaan = Perusahaan::orderByDesc('nomor')->get();
        return view('/erp/master/perusahaan/index', [
            'breadcrumbs' => $breadcrumbs,
            'perusahaan' => $perusahaan
        ]);
    }

    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
