<?php

namespace App\Http\Controllers;

use App\Models\Proposal; 
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with('organization')->latest()->paginate(10);
        return view('pages.manager.proposal.manager_proposal', compact('proposals'));
    }

    public function show($id)
    {
        $proposal = Proposal::with(['user', 'organization', 'budgets'])->findOrFail($id);
        return view('pages.manager.proposal.manager_detailproposal', compact('proposal'));
    }

    public function updateAction(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        $request->validate([
            'action'  => 'required|in:approved,rejected,revision', 
            'catatan' => 'nullable|string', 
        ]);

        if (in_array($request->action, ['rejected', 'revision']) && empty($request->catatan)) {
            return back()->with('error', 'Mohon isi catatan alasan penolakan/revisi.');
        }

        $proposal->update([
            'status'         => $request->action,
            'catatan_revisi' => $request->catatan,
            'approved_by'    => auth()->id(), 
        ]);

        $message = '';
        if ($request->action == 'approved') $message = 'Proposal berhasil disetujui!';
        elseif ($request->action == 'rejected') $message = 'Proposal ditolak.';
        else $message = 'Proposal diminta untuk direvisi.';

        return back()->with('success', $message);
    }
}