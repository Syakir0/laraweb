<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\MahasiswaResource;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan list data mahasiswa
     */
    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::when($request->q, function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->q . '%')
                      ->orWhere('nim', 'like', '%' . $request->q . '%')
                      ->orWhere('prodi_id', 'like', '%' . $request->q . '%');
            })
            ->latest()
            ->paginate(5);

        return new MahasiswaResource(true, 'List Data Mahasiswa', $mahasiswas);
    }

    /**
     * Simpan data mahasiswa baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim'      => 'required|unique:mahasiswas',
            'nama'     => 'required',
            'prodi_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mahasiswa = Mahasiswa::create([
            'nama'     => $request->nama,
            'nim'      => $request->nim,
            'prodi_id' => $request->prodi_id,
        ]);

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Disimpan!', $mahasiswa);
    }

    /**
     * Menampilkan detail mahasiswa
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return new MahasiswaResource(true, 'Detail Data Mahasiswa!', $mahasiswa);
    }

    /**
     * Update data mahasiswa
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validator = Validator::make($request->all(), [
            'nim'      => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama'     => 'required',
            'prodi_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mahasiswa->update([
            'nama'     => $request->nama,
            'nim'      => $request->nim,
            'prodi_id' => $request->prodi_id,
        ]);

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diupdate!', $mahasiswa);
    }

    /**
     * Hapus data mahasiswa
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Dihapus!', null);
    }
}
