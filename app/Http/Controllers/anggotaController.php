<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\pinjamBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class anggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::all();
        return view('anggota.index', compact('books'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loans = pinjamBuku::all();
        return view('anggota.create', compact('loans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $book = Book::findOrFail($request->input('book_id')); 

        if ($book->jumlah_stok <= 0 || $book->status === false) { 
            // jika jumlah stok lebih dari sama dengan 0 atau status buku sama dengan gagal mka akan di arahkan
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');


        }

        //jika buku tersedia maka akan menjalankan perintah berikut

        $book->decrement('jumlah_stok');
        //mengurangi jumlah stock buku

        pinjamBuku::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'borrowed',
        ]);

        if($book->jumlah_stok <= 0) {
            $book->update([
                'status' => false,
                'loan_status' => 'borrowed',
            ]);
        } else {
            $book->update([
                'loan_status' => 'borrowed', // Buku tetap bisa dipinjam tapi statusnya tidak berubah jadi tidak tersedia
            ]);
        }

        return redirect()->back();
    }

    public function returnBook($loanId)
    {
        $loans = pinjamBuku::findOrFail($loanId);
        $book = $loans->book;


        $book->update([ // Update status buku
            'status' => true, // Buku tersedia
            'loan_status' => 'returned', // Buku sudah dikembalikan
        ]);

        $loans->update([ // Update status peminjaman
            'status' => 'returned',
            'tanggal_kembali' => now(),
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }
    public function kembalikanBuku(pinjamBuku $pinjam)
    {
        DB::beginTransaction();

        try {
            // Update status peminjaman
            $pinjam->status = 'available';
            $pinjam->tanggal_kembali = now();
            $pinjam->save();

            // Tambah stok buku
            $book = book::findOrFail($pinjam->book_id);
            $book->jumlah_stok += 1;
            $book->status = true; // Set status to true (Tersedia)
            $book->loan_status = 'available';
            $book->save();

            // $pinjam->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengembalikan buku');
        }
    }


    public function perpanjangTanggal(Request $request, pinjamBuku $pinjam)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date|after:'.$pinjam->tanggal_kembali,
        ]);

        $pinjam->update([
            'tanggal_kembali' => $request->input('tanggal_kembali'),
        ]);

        return redirect()->back()->with('success', 'Tanggal pengembalian berhasil diperpanjang.');
    }

    public function kembalikanPaksa($id)
{
    $pinjam = pinjamBuku::findOrFail($id);

    // Lakukan logika pengembalian paksa
    DB::beginTransaction();

    try {
        // Update status peminjaman
        $pinjam->status = 'returned';
        $pinjam->tanggal_kembali = now();
        $pinjam->save();

        // Tambah stok buku
        $book = book::findOrFail($pinjam->book_id);
        $book->increment('jumlah_stok');
        $book->status = true; // Set status buku menjadi tersedia lagi
        $book->save();

        // Hapus data pinjaman

        // $pinjam->delete();

        DB::commit();

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan secara paksa.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Terjadi kesalahan saat mengembalikan buku.');
    }
}



    public function loanHistory()
    {
        $books = book::all();
        $pinjamBukus = pinjamBuku::all();
        return view('admin.loansHistory', compact('books', 'pinjamBukus'));

    }
    

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
