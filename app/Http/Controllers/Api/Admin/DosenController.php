<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    // 🔹 Tampilkan semua data dosen
    public function index()
    {
        $dosens = Dosen::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua dosen',
            'data' => $dosens,
        ]);
    }

    // 🔹 Simpan data dosen baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'nullable|unique:dosens,nidn',
            'nip' => 'nullable|unique:dosens,nip',
            'tmt' => 'nullable|date',
            'nama_lengkap' => 'required|string|max:255',
            'pangkat_id' => 'nullable|integer',
            'jenis_kelamin' => 'nullable|boolean',
            'foto' => 'nullable|string',
            'kelompok_bidang_keahlian_id' => 'nullable|integer',
            'bidang_keilmuan' => 'nullable|string',
            'jabatan_fungsional' => 'nullable|string',
            'status' => 'nullable|string',
            'user_id' => 'nullable|integer',
            'program_studi_id' => 'nullable|integer',
        ]);

        $dosen = Dosen::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data dosen berhasil ditambahkan',
            'data' => $dosen,
        ], 201);
    }

    // 🔹 Tampilkan detail dosen
    public function show($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Data dosen tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data dosen',
            'data' => $dosen,
        ]);
    }

    // 🔹 Update data dosen
    public function update(Request $request, $id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Data dosen tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'nidn' => 'nullable|unique:dosens,nidn,' . $id,
            'nip' => 'nullable|unique:dosens,nip,' . $id,
            'tmt' => 'nullable|date',
            'nama_lengkap' => 'required|string|max:255',
            'pangkat_id' => 'nullable|integer',
            'jenis_kelamin' => 'nullable|boolean',
            'foto' => 'nullable|string',
            'kelompok_bidang_keahlian_id' => 'nullable|integer',
            'bidang_keilmuan' => 'nullable|string',
            'jabatan_fungsional' => 'nullable|string',
            'status' => 'nullable|string',
            'user_id' => 'nullable|integer',
            'program_studi_id' => 'nullable|integer',
        ]);

        $dosen->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data dosen berhasil diperbarui',
            'data' => $dosen,
        ]);
    }

    // 🔹 Hapus data dosen
    public function destroy($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Data dosen tidak ditemukan',
            ], 404);
        }

        $dosen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data dosen berhasil dihapus',
        ]);
    }
}
