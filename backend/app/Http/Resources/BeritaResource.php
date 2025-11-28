<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BeritaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'ringkasan' => $this->ringkasan,
            'isi' => $this->isi,
            
            // PENTING: Mengubah nama file (gambar.jpg) menjadi Full URL (http://localhost:8000/storage/berita/gambar.jpg)
            // Jadi frontend tinggal pakai saja tanpa mikir path storage
            'gambar_url' => $this->gambar ? url('storage/berita/' . $this->gambar) : null,
            
            // Info Penulis (Relasi ke User)
            // Mengambil nama user jika ada relasinya
            'penulis' => $this->user ? $this->user->name : 'Admin',
            
            // Format Tanggal yang enak dibaca
            'tanggal' => $this->created_at->format('d F Y'), // Contoh: 28 November 2025
            'waktu_lalu' => $this->created_at->diffForHumans(), // Contoh: "2 jam yang lalu"
            
            // Data asli timestamp (opsional, buat sorting)
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}