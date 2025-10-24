<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosen extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nidn',
        'nip',
        'tmt',
        'nama_lengkap',
        'pangkat_id',
        'jenis_kelamin',
        'foto',
        'kelompok_bidang_keahlian_id',
        'bidang_keilmuan',
        'jabatan_fungsional',
        'status',
        'user_id',
        'program_studi_id',
    ];

    // Relasi opsional
    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class);
    }

    public function kelompokBidangKeahlian()
    {
        return $this->belongsTo(KelompokBidangKeahlian::class);
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
