<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil jumlah data per halaman dari request, default 10
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');
        
        $query = DB::table('absensi as a')
            ->join('pegawai as p', 'a.pegawai_id', '=', 'p.id')
            ->select([
                'a.id',
                'p.nama',
                'a.tanggal',
                'a.created_at'
            ]);
            
        // Tambahkan filter pencarian jika ada
        if (!empty($search)) {
            $query->where('p.nama', 'like', "%{$search}%")
                  ->orWhere('a.tanggal', 'like', "%{$search}%");
        }
        
        // Hitung total data sebelum pagination
        $totalData = $query->count();
        
        // Ambil data dengan pagination
        $absensi = $query->orderBy('a.tanggal', 'desc')
                        ->paginate($perPage);
        
        // Hitung data yang ditampilkan
        $showing = $absensi->total();
        $from = $absensi->firstItem() ?? 0;
        $to = $absensi->lastItem() ?? 0;

        $pegawai = DB::table('pegawai')->get();

        return view('absensi.index', compact(
            'absensi', 
            'pegawai', 
            'perPage',
            'totalData',
            'showing',
            'from',
            'to'
        ));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id',
                'tanggal' => 'required|date'
            ]);

            // Cek apakah sudah absen hari ini
            $exists = DB::table('absensi')
                ->where('pegawai_id', $request->pegawai_id)
                ->where('tanggal', $request->tanggal)
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pegawai sudah absen pada tanggal ini'
                ], 422);
            }

            DB::table('absensi')->insert([
                'pegawai_id' => $request->pegawai_id,
                'tanggal' => $request->tanggal,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Absensi berhasil dicatat'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function filter(Request $request)
    {
        $query = DB::table('absensi as a')
            ->join('pegawai as p', 'a.pegawai_id', '=', 'p.id')
            ->select([
                'a.id',
                'p.nama',
                'a.tanggal',
                'a.created_at'
            ]);

        if ($request->pegawai_id) {
            $query->where('a.pegawai_id', $request->pegawai_id);
        }

        if ($request->tanggal_mulai) {
            $query->where('a.tanggal', '>=', $request->tanggal_mulai);
        }

        if ($request->tanggal_akhir) {
            $query->where('a.tanggal', '<=', $request->tanggal_akhir);
        }

        $absensi = $query->orderBy('a.tanggal', 'desc')->get();

        return response()->json($absensi);
    }
        public function destroy($id)
    {
        try {
            $absensi = Absensi::findOrFail($id); // Cari data absensi berdasarkan ID
            $absensi->delete(); // Hapus data
            
            return response()->json([
                'success' => true,
                'message' => 'Absensi berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus absensi. Silakan coba lagi.'
            ], 500);
        }
    }
}
