<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProposalBudgetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'nama_barang'  => $this->nama_barang, 
            'jumlah'       => (int) $this->jumlah,
            'harga'        => (float) $this->harga,
            'subtotal'     => (float) $this->subtotal,
        ];
    }
}