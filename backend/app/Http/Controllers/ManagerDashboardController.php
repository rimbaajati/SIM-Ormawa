<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Event;
use App\Models\User;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        // 1. STATISTIK GLOBAL (Menghitung SEMUA data di database)
        $totalProposals = Proposal::count();
        $pendingProposals = Proposal::where('status', 'pending')->count();
        $approvedProposals = Proposal::where('status', 'approved')->count();
        $rejectedProposals = Proposal::where('status', 'rejected')->count();

        // 2. DATA MONITORING TERBARU
        // Ambil 5 proposal terakhir dari SIAPAPUN pengirimnya
        // Kita gunakan 'with' agar query efisien (Eager Loading)
        $recentProposals = Proposal::with('organization') 
                                   ->latest()
                                   ->take(5)
                                   ->get();

        return view('pages.manager.manager_dashboard', compact(
            'totalProposals',
            'pendingProposals',
            'approvedProposals',
            'rejectedProposals',
            'recentProposals'
        ));
    }
}