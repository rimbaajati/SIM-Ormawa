<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index(){
      if (Auth::user()->role !== 'manager') {
          abort(403);
      }

      $totalProposal   = Proposal::count();
      $pendingProposal = Proposal::where('status', 'pending')->count();
      $approvedProposal = Proposal::where('status', 'approved')->count();
      $rejectedProposal = Proposal::where('status', 'rejected')->count();

      $proposals = Proposal::with('user')->latest()->take(10)->get(); // 10 terbaru

      return view('pages.manager.manager_dashboard', compact(
          'totalProposal',
          'pendingProposal',
          'approvedProposal',
          'rejectedProposal',
          'proposals'
      ));
  }

}