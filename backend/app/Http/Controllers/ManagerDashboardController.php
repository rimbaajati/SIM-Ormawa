<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;  // Pastikan model Proposal ada dan memiliki relasi ormawa

class ManagerDashboardController extends Controller
{
    public function index()
    {
        // Hitung total pengajuan
        $totalPengajuan = Proposal::count();

        // Hitung berdasarkan status
        $pending = Proposal::where('status', 'pending')->count();
        $approved = Proposal::where('status', 'approved')->count();
        $rejected = Proposal::where('status', 'rejected')->count();

        // Ambil pengajuan terbaru (dengan relasi ormawa) untuk tabel
        $recentProposals = Proposal::with('ormawa')  // Asumsikan relasi belongsTo ke Ormawa
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Data untuk chart (array asosiatif untuk status)
        $statusData = [
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected,
        ];

        // Kirim data ke view
        return view('manager.manager_dashboard', compact(
            'totalPengajuan',
            'pending',
            'approved',
            'rejected',
            'recentProposals',
            'statusData'
        ));
    }
}