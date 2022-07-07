<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coa extends Model
{
    use SoftDeletes;
    protected $table = 'coas';
    protected $fillable = [
        'nomor',
        'nama',
        'aktif',
        'nomorgrupcoa',
        'nomortipetanaman',
        'nomorstatuslahan',
        'kategoricoa',
        'nomortipeakun',
        'nomorposisikeuangan',
        'nomorlabarugi',
        'kepemilikancoa',
        'satuan',
    ];
    protected $hidden;
    public $primaryKey = 'nomor';
    public $timestamps = false;
}
