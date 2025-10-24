<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pangkat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_pangkat',
        'golongan',
        'ruang',
    ];

    public function dosens()
    {
        return $this->hasMany(Dosen::class);
    }
}
