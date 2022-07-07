<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Settings extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode';
    public $incrementing = true;
    protected $guarded = array();

    public function getDataIcons()
    {
        return DB::table('icons')->select('kode', 'nama')->orderBy('nama','asc')->get();
    }

    public function getDataMenu()
    {
        return DB::table('menu')->select('kode', 'name', 'icon', 'url', 'active')->orderBy('name','asc')->get();
    }

    public function getSideBar()
    {
        return DB::table('menu')->select('kode', 'name', 'icon', 'url', 'class', 'parent')
                                ->where('active','Y')
                                ->orderBy('kode','asc')
                                ->orderBy('sequence','asc')->get();
    }

    public function storeDataMenu($input)
    {
        return DB::table('menu')->insert($input);
    }

    public function findDataMenu($id)
    {
        return DB::table('menu')->where('kode', $id)->first();
    }

    public function updateDataMenu($id, $input)
    {
        return DB::table('menu')->where('kode', $id)->update($input);
    }

    public function deleteDataMenu($id)
    {
        return DB::table('menu')->where('kode', $id)->delete();
    }
}
