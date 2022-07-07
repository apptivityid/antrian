<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Icons extends Model
{
    use HasFactory;
    protected $table = 'icons';
    protected $primaryKey = 'kode';
    public $incrementing = true;
    protected $guarded = array();

    public function getData()
    {
        return static::orderBy('nama','asc')->get();
    }
}
