<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelompokBidangKeahlian extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_kelompok',
        'deskripsi',
    ];

    public function dosens()
    {
        return $this->hasMany(Dosen::class);
    }
}
