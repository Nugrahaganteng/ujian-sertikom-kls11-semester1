<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::all();
        return view ('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');

    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
          $request->validate([
                'judul_buku' => 'required|string|max:255',
                'penulis' => 'required|string|max:255',
                'kategori' => 'required|string',
                'tahun_terbit' => 'required|date',
                'jumlah_stok' => 'required|integer',
                'status' => 'required|string',
                'deskripsi' => 'required|string',
            ]);

    
            book::create($request->all());

            return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    
        //     return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
        // }
    } }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $books = book::findOrFail($id);
        return view('books.edit', compact('books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul_buku'=>'required',
           'penulis'=>'required',
           'kategori'=>'required',
           'status'=>'required|boolean',
           'tahun_terbit'=>'required|date',
           'jumlah_stok'=>'required|integer',
           'deskripsi'=>'required',
       ]);
            $books= book::findOrFail($id);

         $books->update($request->all());

         return redirect('books');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        
        // Hapus buku
        $book->delete();
        
        // Redirect dengan pesan sukses
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    
    }

    public function dashboard()
{
    // Jumlah total buku di lemari
    $totalBuku = Book::count();



    // Jumlah buku yg tersedia
   $totalstat = book::where('status', true)->count();

   //buku yang sudah di kembalikan
   $totalava = book::where('status', false)->count();


    // Mengirimkan data ke view
    return view('dashboard', compact('totalBuku', 'totalstat', 'totalava'));
}
}
