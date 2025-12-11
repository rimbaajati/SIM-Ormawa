<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProposalBudgetResource;

class ProposalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_proposal' => $this->id_proposal,
            'judul'       => $this->judul,
            'pengaju'     => $this->user->name, 
            'organisasi'  => $this->organization->name, 
            'status'      => $this->status,
            'total_anggaran' => (int) $this->anggaran,
            'waktu_kegiatan' => date('d M Y', strtotime($this->waktu_mulai)) . ' - ' . date('d M Y', strtotime($this->waktu_selesai)),
            'tanggal_pengajuan' => $this->created_at->format('Y-m-d H:i'),
            'link_file'   => url('storage/' . $this->file_proposal),
            'rincian_anggaran' => ProposalBudgetResource::collection($this->whenLoaded('budgets')),
        ];
    }
}