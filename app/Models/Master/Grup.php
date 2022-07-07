<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grup extends Model
{
    use SoftDeletes;
    protected $table = 'grup';
    protected $fillable = [
        'nama',
        'aktif'
    ];
    protected $hidden;
    public $primaryKey = 'nomor';
    public $timestamps = false;
}
