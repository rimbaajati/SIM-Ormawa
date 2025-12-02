<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Ganti dengan jalur Model yang benar, jika berbeda:
use App\Models\Proposal; 
use App\Models\Organization; 

class HomeController extends Controller
{
    // Fungsi untuk Dashboard Umum (Jika ada)
    public function index()
    {
        return view('dashboard');
    }

    // Fungsi untuk Dashboard Manager (Dibutuhkan untuk rute /manage/dashboard)
    public function managerDashboard()
    {
        // PENTING: Gunakan try-catch untuk mencegah seluruh aplikasi crash jika database error
        try {
            // Menggunakan class Model yang di-import
            $totalPengajuan = Proposal::count();
            $pending = Proposal::where('status', 'pending')->count();
            $approved = Proposal::where('status', 'approved')->count();
            $rejected = Proposal::where('status', 'rejected')->count();
            
            // Ambil 5 pengajuan terbaru
            // Pastikan relasi 'organization' didefinisikan dengan benar di Model Proposal
            $latestPengajuan = Proposal::with('organization') 
                                       ->latest()
                                       ->take(5)
                                       ->get();
        } catch (\Exception $e) {
            // Log Error ke file log Laravel (storage/logs)
            \Log::error("Database Error in ManagerDashboard: " . $e->getMessage());

            // Jika gagal mengambil data (misal, tabel belum ada atau Model tidak ditemukan), 
            // kirimkan nilai default yang aman
            $totalPengajuan = 0;
            $pending = 0;
            $approved = 0;
            $rejected = 0;
            $latestPengajuan = collect([]); // Mengirim Collection kosong yang aman di Blade
        }

        // Kirim data ke view
        // Pastikan nama view-nya sudah benar: 'pages.manager.manager_dashboard'
        return view('pages.manager.manager_dashboard', [
            'totalPengajuan' => $totalPengajuan,
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected,
            'latestPengajuan' => $latestPengajuan,
        ]);
    }
}