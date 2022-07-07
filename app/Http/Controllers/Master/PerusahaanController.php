<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
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
    public function create(Request $request)
    {
        //
        $data=Perusahaan::create([
            'nomor' => $request->id_perusahaan,
            'nama' => $request->nama_perusahaan,
            'nogrup' => $request->nogroup,
            'telp' => $request->telp,
            'email' => $request->email,
            'fax' => $request->fax,
            'alamat' => $request->alamat,
            'penambah' => $request->nama_perusahaan,
            'pengubah' => $request->nama_perusahaan,
            'aktif' => 'Y'
        ]);
        $data->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
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
        $perusahaandet = perusahaan::find($id);
        return response()->json(
            [
                'data' => $perusahaandet
            ]
        );
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
        $perdet = perusahaan::find($id);
        $perdet->nama = request('nama_perusahaan');
        $perdet->nama = request('nama_perusahaan');
        $perdet->nogrup = request('nogroup');
        $perdet->telp = request('telp');
        $perdet->email = request('email');
        $perdet->fax = request('fax');
        $perdet->alamat = request('alamat');
        $perdet->penambah = request('nama_perusahaan');
        $perdet->pengubah = request('nama_perusahaan');
        $perdet->aktif = 'Y';
        $perdet->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Ubah data sukses'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $grup = Perusahaan::where('nomor', $id)->delete();
    }
}
