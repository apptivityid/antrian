<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Coa as MasterCoa;

class CoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $MasterCoa = new MasterCoa;
        $MasterCoa->nomor = $request->nomor;
        $MasterCoa->nama = $request->nama;
        $MasterCoa->nomorgrupcoa = $request->nomorgrupcoa;
        $MasterCoa->nomortipetanaman = $request->nomortipetanaman;
        $MasterCoa->nomorstatuslahan = $request->nomorstatuslahan;
        $MasterCoa->nomortipetanaman = $request->nomortipetanaman;
        $MasterCoa->kategoricoa = $request->kategoricoa;
        $MasterCoa->nomortipeakun = $request->nomortipeakun;
        $MasterCoa->nomorposisikeuangan = $request->nomorposisikeuangan;
        $MasterCoa->nomorlabarugi = $request->nomorlabarugi;
        $MasterCoa->kepemilikancoa = $request->kepemilikancoa;
        $MasterCoa->satuan = $request->satuan;
        $MasterCoa->nomortipetanaman = $request->namaforeign;
        $MasterCoa->tglditambah = now();
        $MasterCoa->tgldiubah = now();
        $MasterCoa->aktif = $request->aktif;
        $MasterCoa->save();
        return redirect()->back();
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
        $grup = MasterCoa::where('nomor',$id)->delete();
        return redirect()->back();
    }
}
