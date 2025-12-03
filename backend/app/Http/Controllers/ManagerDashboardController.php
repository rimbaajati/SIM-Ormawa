<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;  // Pastikan model Proposal ada dan memiliki relasi ormawa

class ManagerDashboardController extends Controller
{
    public function index()
{
    $totalPengajuan = Proposal::count();

    $pending = Proposal::where('status', 'pending')->count();
    $approved = Proposal::where('status', 'approved')->count();
    $rejected = Proposal::where('status', 'rejected')->count();

    $recentProposals = Proposal::with('ormawa')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    $statusData = [
        'pending' => $pending,
        'approved' => $approved,
        'rejected' => $rejected,
    ];

    return view('pages.manager.manager_dashboard', compact(
        'totalPengajuan',
        'pending',
        'approved',
        'rejected',
        'recentProposals',
        'statusData'
    ));
}
}