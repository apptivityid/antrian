<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Konsultasi extends Model
{
    use HasFactory;
    protected $table = 'konsultasi';

    protected $fillable = [
        'id_pasien',
        'tanggal',
        'keterangan',
        'resep',
        'created_by',
        'updated_by',
        'ip_address'
    ];

    public function getDataPasien()
    {
        return DB::table('pasien')->select('id', 'nama', 'no_ktp')->orderBy('nama','asc')->get();
    }

    public function getData()
    {
        return static::join('pasien', 'pasien.id', '=', 'konsultasi.id_pasien')
                        ->select('konsultasi.id', 'konsultasi.id_pasien', 'konsultasi.tanggal', 'pasien.nama', 'pasien.no_ktp')
                        ->orderBy('konsultasi.tanggal','desc')
                        ->get();
    }

    public function viewData($id)
    {
        return static::join('pasien', 'pasien.id', '=', 'konsultasi.id_pasien')
                        ->select('konsultasi.id', 'konsultasi.id_pasien', 'konsultasi.tanggal', 'pasien.nama', 'pasien.no_ktp')
                        ->where('konsultasi.id', $id)
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
