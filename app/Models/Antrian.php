<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Antrian extends Model
{
    use HasFactory;
    protected $table = 'antrian';

    protected $fillable = [
        'id_pasien',
        'tanggal',
        'id_poliklinik',
        'created_by',
        'updated_by',
        'ip_address'
    ];

    public function getNomor()
    {
        // return static::where([
        //                 ['id_poliklinik', '=', $poli],
        //                 ['tanggal', '=', $tanggal]
        //              ])
        //              ->select('no_antrian')
        //              ->first()
        //              ->no_urutan ?? 0;
        return static::orderBy('no_antrian', 'desc')
                     ->first();
    }

    public function getDataPasien($name)
    {
        return DB::table('users')
                        ->join('pasien', 'pasien.nama_pengguna', '=', 'users.name')
                        ->select('pasien.id')
                        ->where('users.name', $name)
                        ->first();
    }

    public function getData()
    {
        return static::join('pasien', 'pasien.id', '=', 'antrian.id_pasien')
                        ->join('poli', 'poli.id', '=', 'antrian.id_poliklinik')
                        ->select('antrian.id', 'antrian.id_pasien', 'antrian.no_antrian', 'antrian.tanggal', 'pasien.nama', 'pasien.no_ktp', 'poli.nama AS poliklinik')
                        ->orderBy('antrian.tanggal','desc')
                        ->get();
    }

    public function viewData($id)
    {
        return static::join('pasien', 'pasien.id', '=', 'antrian.id_pasien')
                        ->join('poli', 'poli.id', '=', 'antrian.id_poliklinik')
                        ->select('antrian.id', 'antrian.id_pasien', 'antrian.tanggal', 'pasien.nama', 'pasien.no_ktp', 'poli.nama AS poliklinik')
                        ->where('antrian.id', $id)
                        ->first();
    }

    public function storeData($input)
    {
        return static::create($input);
    }

    public function findData($id)
    {
        return static::find($id);
    }

    public function updateData($id, $input)
    {
        return static::find($id)->update($input);
    }

    public function deleteData($id)
    {
        return static::find($id)->delete();
    }
}
