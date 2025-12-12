<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSuratSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jenis_surats')->insert([
            ['nama_jenis' => 'Surat Keputusan (SK)'],
            ['nama_jenis' => 'Surat Undangan'],
            ['nama_jenis' => 'Surat Permohonan'],
            ['nama_jenis' => 'Surat Pemberitahuan'],
            ['nama_jenis' => 'Surat Peminjaman'],
            ['nama_jenis' => 'Berita Acara'],
            ['nama_jenis' => 'Sertifikat'],
            ['nama_jenis' => 'Laporan Pertanggungjawaban (LPJ)'],
            ['nama_jenis' => 'Proposal'],
        ]);
    }
}