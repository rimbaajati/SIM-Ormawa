<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Organization;
use App\Models\ProposalBudget;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    // INDEX
    public function index()
    {
        $proposals = Proposal::latest()->paginate(10);
        return view('pages.manager.proposal.manager_allproposal', compact('proposals'));
    }

    // CREATE
    public function create(): View
    {
        $organizations = Organization::orderBy('name')->get();
        return view('pages.manager.proposal.manager_createproposal', compact('organizations'));
    }

    // STORE 
    public function store(Request $request): RedirectResponse 
    {
        // 1. Validasi Input
        $request->validate([
            'judul'           => 'required|string|max:255',
            'id_organization' => 'required|exists:organizations,id_organization',
            'deskripsi'       => 'required',
            'waktu_mulai' => 'required|date', 
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            'tempat'          => 'required',
            'anggaran'        => 'nullable|numeric',
            'file_proposal'   => 'required|mimes:pdf|max:2048',
        ]);

        // 2. Ambil Data Organisasi
        $organization = Organization::findOrFail($request->id_organization);
        
        // Ambil kode string (misal: UKM-001) dari kolom id_organization
        $orgCode = $organization->code ?? $organization->id_organization;

        // 3. Generate Variabel untuk Nomor Proposal
        $now = Carbon::now();
        $bulanRomawi = $this->getRomanMonth($now->month);
        $tahun = $now->year;
        
        // Panggil fungsi sequence
        $noUrut = $this->getLatestSequence($request->id_organization, $tahun);

        // 4. Rakit Nomor Proposal
        // Format: PROP/UKM-001/II/2026/001
        $nomorProposalJadi = "PROP/{$orgCode}/{$bulanRomawi}/{$tahun}/{$noUrut}";

        // 5. Upload File
      $filePath = null; 
        if ($request->hasFile('file_proposal')) {
            $filePath = $request->file('file_proposal')->store('proposals', 'public');
        }

        // 6. Simpan ke Database
        Proposal::create([
            'id_proposal'     => $nomorProposalJadi,
            'judul'           => $request->judul,
            'id_organization' => $request->id_organization,
            'deskripsi'       => $request->deskripsi,
            'waktu_mulai'     => $request->waktu_mulai,
            'waktu_selesai'   => $request->waktu_selesai,
            'tempat'          => $request->tempat,
            'anggaran'        => $request->anggaran,
            'file_proposal'   => $filePath,
            'status'          => 'pending',
            'id_user'         => Auth::id(),
        ]);

        return redirect()->route('manager.proposal.all')
            ->with('success', 'Proposal berhasil diajukan dengan nomor: ' . $nomorProposalJadi);
    }

    // --- FUNGSI TAMBAHAN ---

    // 1. Fungsi ubah angka bulan ke Romawi
    private function getRomanMonth($month)
    {
        $map = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        return $map[$month] ?? 'I';
    }

    // 2. Fungsi cari nomor urut terakhir per organisasi & tahun
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

    // SHOW
    public function show(Proposal $proposal): View
    {
        return view('pages.manager.proposal.manager_detailproposal', compact('proposal'));
    }

    // EDIT
    public function edit(Proposal $proposal): View
    {
        $this->authorizeAccess($proposal);
        $organizations = Organization::orderBy('name')->get();
        return view('pages.manager.proposal.manager_editproposal', compact('proposal', 'organizations'));
    }

    // UPDATE 
    public function update(Request $request, Proposal $proposal): RedirectResponse
    {
        $this->authorizeAccess($proposal);

        $request->validate([
            'judul'           => 'required|string|max:255',
            'id_organization' => 'required|exists:organizations,id',
            'deskripsi'       => 'required',
            'waktu'           => 'required|date',
            'tempat'          => 'required',
            'anggaran'        => 'required|numeric',
            'file_proposal'   => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = [
            'judul'           => $request->judul,
            'id_organization' => $request->id_organization, // Update ID Organisasi
            // 'organisasi'   => ... HAPUS INI KARENA KOLOM SUDAH DIHAPUS
            'deskripsi'       => $request->deskripsi,
            'waktu'           => $request->waktu,
            'tempat'          => $request->tempat,
            'anggaran'        => $request->anggaran,
        ];

        if ($request->hasFile('file_proposal')) {
            if($proposal->file_proposal) {
                Storage::disk('public')->delete($proposal->file_proposal);
            }
            $data['file_proposal'] = $request->file('file_proposal')->store('proposals', 'public');
        }

        $proposal->update($data);

        return redirect()->route('manager.proposal.all')
            ->with('success', 'Proposal berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Proposal $proposal): RedirectResponse
    {
        $this->authorizeAccess($proposal);

        if($proposal->file_proposal) {
             Storage::disk('public')->delete($proposal->file_proposal);
        }
        
        $proposal->delete();

        return redirect()->route('manager.proposal.all')
            ->with('success', 'Proposal berhasil dihapus.');
    }

    // Authorize
    private function authorizeAccess(Proposal $proposal)
    {
        // Ubah user_id jadi id_user sesuai database Anda
        if ($proposal->id_user !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
    }

    // --- FITUR UPDATE ANGGARAN ---
   public function updateBudget(Request $request, Proposal $proposal)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_barang.*' => 'required|string',
            'harga.*'       => 'required|numeric|min:0',
            'jumlah.*'      => 'required|numeric|min:1',
        ]);

        // 2. Reset Data Rincian Lama (Hapus dulu biar bersih)
        \App\Models\ProposalBudget::where('id_proposal', $proposal->id_proposal)->delete();

        // Siapkan variabel penampung total = 0
        $grandTotal = 0; 

        // 3. Simpan Rincian Baru & Hitung Ulang Total
        if ($request->has('nama_barang')) {
            foreach ($request->nama_barang as $index => $itemNamaBarang) {
                
                if (!empty($itemNamaBarang)) {
                    
                    // Ambil angka dari input form
                    $hargaInput = $request->harga[$index];
                    $qtyInput   = $request->jumlah[$index];
                    
                    // Hitung Subtotal per baris (PHP yang menghitung, bukan JS)
                    $subtotal   = $hargaInput * $qtyInput;

                    // Simpan ke Tabel Rincian (proposal_budgets)
                    \App\Models\ProposalBudget::create([
                        'id_proposal' => $proposal->id_proposal,
                        'nama_barang' => $itemNamaBarang,
                        'harga'       => $hargaInput,
                        'jumlah'      => $qtyInput,
                        'subtotal'    => $subtotal,
                    ]);

                    // --- INI BAGIAN PENTINGNYA ---
                    // Setiap baris disimpan, tambahkan subtotalnya ke Grand Total
                    $grandTotal += $subtotal; 
                }
            }
        }

        // 4. UPDATE TABEL PROPOSAL UTAMA
        // Masukkan hasil penjumlahan ($grandTotal) ke kolom 'anggaran'
        $proposal->update([
            'anggaran' => $grandTotal
        ]);

        return redirect()->back()->with('success', 'Rincian disimpan & Total Anggaran (Rp ' . number_format($grandTotal, 0, ',', '.') . ') berhasil diupdate!');
    }
}