<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';

    protected $fillable = [
        'no_ktp',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'umur',
        'jenis_kelamin',
        'alamat',
        'pekerjaan',
        'nama_ortu',
        'no_telp',
        'keterangan',
        'nama_pengguna',
        'email',
        'created_by',
        'updated_by',
        'ip_address'
    ];

    public function getData()
    {
        return static::orderBy('nama','asc')->get();
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
