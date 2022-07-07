<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'grup_perusahaan';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $guarded = array();

    public function getData()
    {
        return static::select('kode', 'nama', 'telp', 'email', 'fax', 'alamat', 'aktif')->orderBy('kode','asc')->get();
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
