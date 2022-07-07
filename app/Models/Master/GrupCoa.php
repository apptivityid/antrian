<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupCoa extends Model
{
    use SoftDeletes;
    protected $table = 'grupcoas';
    protected $fillable = [
        'nomor',
        'nama',
        'aktif'
    ];
    protected $hidden;
    public $primaryKey = 'nomor';
    public $timestamps = false;
}
