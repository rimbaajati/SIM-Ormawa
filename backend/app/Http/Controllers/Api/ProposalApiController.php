<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\Organization;
use App\Http\Resources\ProposalResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProposalApiController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with(['user', 'organization'])->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List Data Proposal',
            'data'    => ProposalResource::collection($proposals)->response()->getData(true)
        ], 200);
    }

    public function show($id)
    {
        $proposal = Proposal::with(['user', 'organization', 'budgets'])->find($id);

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

    // POST: Buat Proposal Baru (Upload)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'judul'           => 'required|string|max:255',
            'id_organization' => 'required|exists:organizations,id', 
            'deskripsi'       => 'required',
            'waktu_mulai'     => 'required|date',
            'waktu_selesai'   => 'required|date|after_or_equal:waktu_mulai',
            'tempat'          => 'required',
            'anggaran'        => 'nullable|numeric',
            'file_proposal'   => 'required|file|mimes:pdf|max:2048', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // 2. Ambil Data Organisasi
        $organization = Organization::findOrFail($request->id_organization);
        $orgCode = $organization->id_organization; 

        // 3. Generate Nomor Proposal
        $now = Carbon::now();
        $bulanRomawi = $this->getRomanMonth($now->month);
        $tahun = $now->year;
        $noUrut = $this->getLatestSequence($request->id_organization, $tahun);
        
        $nomorProposalJadi = "PROP/{$orgCode}/{$bulanRomawi}/{$tahun}/{$noUrut}";

        // 4. Upload File
        $filePath = null;
        if ($request->hasFile('file_proposal')) {
            $filePath = $request->file('file_proposal')->store('proposals', 'public');
        }

        // 5. Simpan ke Database
        $proposal = Proposal::create([
            'id_proposal'     => $nomorProposalJadi,
            'judul'           => $request->judul,
            'id_organization' => $request->id_organization,
            'deskripsi'       => $request->deskripsi,
            'waktu_mulai'     => $request->waktu_mulai,
            'waktu_selesai'   => $request->waktu_selesai,
            'tempat'          => $request->tempat,
            'anggaran'        => $request->anggaran ?? 0,
            'file_proposal'   => $filePath,
            'status'          => 'pending',
            'id_user'         => Auth::id(), 
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Proposal Berhasil Diajukan',
            'data'    => new ProposalResource($proposal)
        ], 201);
    }

    // --- FUNGSI BANTUAN (PRIVATE) ---

    private function getRomanMonth($month)
    {
        $map = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        return $map[$month] ?? 'I';
    }

    private function getLatestSequence($orgId, $year)
    {
        $lastProposal = Proposal::where('id_organization', $orgId)
            ->whereYear('created_at', $year)
            ->latest('created_at')
            ->first();

        if ($lastProposal && $lastProposal->id_proposal) {
            $parts = explode('/', $lastProposal->id_proposal);
            $lastNumber = end($parts);
            $newNumber = (int)$lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        return str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}