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
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $request->validate([ // 1. Validasi Input
            'judul'           => 'required|string|max:255',
            'id_organization' => 'required|exists:organizations,id', 
            'deskripsi'       => 'required',
            'waktu_mulai'     => 'required|date', 
            'waktu_selesai'   => 'required|date|after_or_equal:waktu_mulai',
            'tempat'          => 'required',
            'anggaran'        => 'nullable|numeric',
            'file_proposal'   => 'required|mimes:pdf|max:2048',
        ]);

        $organization = Organization::findOrFail($request->id_organization); // 2. Ambil Data Organisasi (Berdasarkan ID Angka)
        $orgCode = $organization->id_organization; 

        $now = Carbon::now(); // 3. Generate Variabel untuk Nomor Proposal
        $bulanRomawi = $this->getRomanMonth($now->month);
        $tahun = $now->year;
        
        $noUrut = $this->getLatestSequence($request->id_organization, $tahun);
        $nomorProposalJadi = "PROP/{$orgCode}/{$bulanRomawi}/{$tahun}/{$noUrut}"; // 4. Rakit Nomor Proposal (PROP/UKM-001/XII/2025/001)

        $filePath = null;  // 5. Upload File
        if ($request->hasFile('file_proposal')) {
            $filePath = $request->file('file_proposal')->store('proposals', 'public');
        }

        Proposal::create([ // 6. Simpan ke Database
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

        return redirect()->route('manager.proposal.all')
            ->with('success', 'Proposal berhasil diajukan dengan nomor: ' . $nomorProposalJadi);
    }

    // FUNGSI BANTUAN
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
            'waktu_mulai'     => 'required|date',
            'waktu_selesai'   => 'required|date|after_or_equal:waktu_mulai',
            'tempat'          => 'required',
            'anggaran'        => 'required|numeric',
            'file_proposal'   => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = [
            'judul'           => $request->judul,
            'id_organization' => $request->id_organization, 
            'deskripsi'       => $request->deskripsi,
            'waktu_mulai'     => $request->waktu_mulai,
            'waktu_selesai'   => $request->waktu_selesai,
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
        if ($proposal->id_user !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
    }

    // --- FITUR UPDATE ANGGARAN (MANUAL) ---
    public function updateBudget(Request $request, Proposal $proposal)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_barang.*' => 'required|string',
            'harga.*'       => 'required|numeric|min:0',
            'jumlah.*'      => 'required|numeric|min:1',
        ]);

        // 2. Reset Data Rincian Lama
        // PENTING: Gunakan 'proposal_id' dan $proposal->id (Integer)
        ProposalBudget::where('proposal_id', $proposal->id)->delete();

        $grandTotal = 0; 

        // 3. Simpan Rincian Baru & Hitung Ulang Total
        if ($request->has('nama_barang')) {
            foreach ($request->nama_barang as $index => $itemNamaBarang) {
                
                if (!empty($itemNamaBarang)) {
                    
                    $hargaInput = $request->harga[$index];
                    $qtyInput   = $request->jumlah[$index];
                    $subtotal   = $hargaInput * $qtyInput;

                    // Simpan ke Tabel Rincian (proposal_budgets)
                    ProposalBudget::create([
                        // Pakai proposal_id (sesuai migrasi proposal_budgets) merujuk ke ID Angka
                        'proposal_id'  => $proposal->id, 
                        'nama_barang'  => $itemNamaBarang,
                        'harga_satuan' => $hargaInput, // Sesuaikan nama kolom DB (harga_satuan/harga)
                        'jumlah'       => $qtyInput,
                        'subtotal'     => $subtotal,
                    ]);

                    $grandTotal += $subtotal; 
                }
            }
        }

        // Update Total Anggaran di Tabel Utama
        $proposal->update([
            'anggaran' => $grandTotal
        ]);

        return redirect()->back()->with('success', 'Rincian disimpan & Total Anggaran diperbarui!');
    }

    // --- FITUR IMPORT EXCEL ---
    public function importBudget(Request $request, Proposal $proposal)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls|max:2048'
        ]);

        try {
            $file = $request->file('file_excel');
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            DB::beginTransaction();

            // Hapus data lama berdasarkan ID Proposal (Integer)
            ProposalBudget::where('proposal_id', $proposal->id)->delete();

            $grandTotal = 0;
            $countItem = 0;

            foreach ($rows as $key => $row) {
                if ($key == 0) continue; // Skip Header

                $nama_barang  = $row[0]; 
                $jumlah       = (int) $row[1];
                $harga_satuan = (float) $row[2];

                if (!empty($nama_barang) && $jumlah > 0) {
                    
                    $subtotal = $jumlah * $harga_satuan;

                    ProposalBudget::create([
                        'proposal_id'  => $proposal->id, // Pakai ID Angka
                        'nama_barang'  => $nama_barang,
                        'jumlah'       => $jumlah,
                        'harga_satuan' => $harga_satuan,
                        'subtotal'     => $subtotal,
                    ]);

                    $grandTotal += $subtotal;
                    $countItem++;
                }
            }

            $proposal->update([
                'anggaran' => $grandTotal
            ]);

            DB::commit();

            return redirect()->back()->with('success', "Berhasil import {$countItem} item. Total: Rp " . number_format($grandTotal));

        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->with('error', 'Gagal import Excel: ' . $e->getMessage());
        }
    }

    // --- DOWNLOAD TEMPLATE ---
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nama Barang');
        $sheet->setCellValue('B1', 'Jumlah');
        $sheet->setCellValue('C1', 'Harga Satuan');

        $sheet->setCellValue('A2', 'Contoh: Sewa Tenda');
        $sheet->setCellValue('B2', 2);
        $sheet->setCellValue('C2', 500000);

        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="template_rab.xlsx"');
        $writer->save('php://output');
        exit;
    }
}