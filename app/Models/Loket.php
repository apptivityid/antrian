<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loket extends Model
{
    use HasFactory;
    protected $table = 'loket';
    protected $guarded = array();

    public function getData()
    {
        return static::join('poli', 'loket.id_poli', '=', 'poli.id')
                        ->select('loket.id', 'loket.nama', 'loket.nomor', 'loket.id_poli', 'poli.nama AS poliklinik')
                        ->orderBy('loket.id_poli','asc')
                        ->orderBy('loket.nama','asc')
                        ->get();
    }

    public function storeData($input)
    {
        return static::create($input);
    }

    public function findData($id)
    {
        return static::find($id);
    }

    public function findDataPoli($id)
    {
        return static::where('id_poli', $id)->get();
    }

    public function updateData($id, $input)
    {
        return static::find($id)->update($input);
    }

    public function updateNomor($id, $id_poli)
    {
        $nomor = static::where('id_poli', $id_poli)->max('nomor');
        return static::where('id', $id)->update(['nomor' => $nomor + 1]);
    }

    public function deleteData($id)
    {
        return static::find($id)->delete();
    }
}
