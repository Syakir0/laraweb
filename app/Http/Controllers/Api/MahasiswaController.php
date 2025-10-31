<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Http\Resources\MahasiswaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Enums\GolonganDarah;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan daftar mahasiswa
     */
    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::with('programStudi')
            ->when($request->q, function ($query) use ($request) {
                $query->where('nama', 'like', "%{$request->q}%")
                    ->orWhere('nim', 'like', "%{$request->q}%")
                    ->orWhereHas('programStudi', function ($q) use ($request) {
                        $q->where('nama', 'like', "%{$request->q}%");
                    });
            })
            ->latest()
            ->paginate(10);

        return new MahasiswaResource(true, 'List Data Mahasiswa', $mahasiswas);
    }

    /**
     * Simpan data mahasiswa baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim'             => 'required|unique:mahasiswas',
            'nama'            => 'required|string|max:100',
            'program_studi_id' => 'required|exists:program_studis,id',
            'email'           => 'required|email|unique:mahasiswas',
            'nomor_hp'        => 'required|string|max:15|unique:mahasiswas',
            'jenis_kelamin'   => 'required|boolean',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'golongan_darah'  => 'nullable|in:A,B,AB,O',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mahasiswa = Mahasiswa::create([
            'nim'             => $request->nim,
            'nama'            => $request->nama,
            'program_studi_id' => $request->program_studi_id,
            'email'           => $request->email,
            'nomor_hp'        => $request->nomor_hp,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'tempat_lahir'    => $request->tempat_lahir,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'golongan_darah'  => $request->golongan_darah
                ? GolonganDarah::from($request->golongan_darah)
                : null,
        ]);

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Disimpan!', $mahasiswa);
    }

    /**
     * Detail mahasiswa
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('programStudi');
        return new MahasiswaResource(true, 'Detail Data Mahasiswa', $mahasiswa);
    }

    /**
     * Update data mahasiswa
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validator = Validator::make($request->all(), [
            'nim'             => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama'            => 'required|string|max:100',
            'program_studi_id' => 'required|exists:program_studis,id',
            'email'           => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
            'nomor_hp'        => 'required|string|max:15|unique:mahasiswas,nomor_hp,' . $mahasiswa->id,
            'jenis_kelamin'   => 'required|boolean',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'golongan_darah'  => 'nullable|in:A,B,AB,O',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mahasiswa->update([
            'nim'             => $request->nim,
            'nama'            => $request->nama,
            'program_studi_id' => $request->program_studi_id,
            'email'           => $request->email,
            'nomor_hp'        => $request->nomor_hp,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'tempat_lahir'    => $request->tempat_lahir,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'golongan_darah'  => $request->golongan_darah
                ? GolonganDarah::from($request->golongan_darah)
                : null,
        ]);

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diupdate!', $mahasiswa);
    }

    /**
     * Hapus mahasiswa
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Dihapus!', null);
    }
}
