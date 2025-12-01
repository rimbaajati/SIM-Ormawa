<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;

class ProposalApiController extends Controller
{
    // contoh method
    public function myProposals() {
        return Proposal::where('user_id', auth()->id())->get();
    }

    public function show($id) {
        $proposal = Proposal::findOrFail($id);
        if ($proposal->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $proposal;
    }

    public function update(Request $request, $id) {
        $proposal = Proposal::findOrFail($id);
        if ($proposal->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $proposal->update($request->only(['title', 'description']));
        return response()->json($proposal);
    }

    public function index() {
        return Proposal::all();
    }

    public function comment(Request $request, $id) {
        $proposal = Proposal::findOrFail($id);
        $proposal->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->input('comment')
        ]);
        return response()->json(['message' => 'Comment added']);
    }

    public function updateStatus(Request $request, $id) {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = $request->input('status');
        $proposal->save();
        return response()->json(['message' => 'Status updated', 'proposal' => $proposal]);
    }
}
