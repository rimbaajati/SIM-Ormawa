<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Http\Resources\ProposalResource;
use Illuminate\Http\Request;

class ProposalApiController extends Controller
{
    // GET: Ambil Semua Proposal
    public function index()
    {
        $proposals = Proposal::with(['user', 'organization'])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Proposal',
            'data'    => ProposalResource::collection($proposals)
        ], 200);
    }

    // GET: Ambil Detail 1 Proposal
    public function show($id)
    {
        $proposal = Proposal::with(['user', 'organization', 'details','budgets'])->find($id);

        if (!$proposal) {
            return response()->json([
                'success' => false,
                'message' => 'Proposal tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Proposal',
            'data'    => new ProposalResource($proposal)
        ], 200);
    }
}