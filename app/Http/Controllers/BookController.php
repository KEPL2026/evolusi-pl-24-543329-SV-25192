<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookCatalogService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(
        protected BookCatalogService $catalogService
    ) {}

    /**
     * Menampilkan daftar buku dan statistik katalog.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $kategori = $request->query('kategori');

        $books = Book::query()
            ->search($search)
            ->category($kategori)
            ->latest()
            ->get();

        $categories = $this->catalogService->getDefaultCategories();
        $stats = $this->catalogService->getStatistics();

        return view('books.index', compact('books', 'categories', 'stats', 'search', 'kategori'));
    }

    /**
     * Menyimpan data buku baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kategori' => 'required|string|max:100',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku referensi berhasil ditambahkan ke katalog.');
    }

    /**
     * Memproses peminjaman buku.
     */
    public function borrow(Request $request, Book $book)
    {
        if (! $book->isAvailable()) {
            return back()->with('error', 'Buku saat ini sedang dipinjam.');
        }

        $validated = $request->validate([
            'peminjam' => 'required|string|max:255',
        ]);

        $book->borrowTo($validated['peminjam']);

        return redirect()->route('books.index')->with('success', "Buku berhasil dipinjam oleh {$book->peminjam}.");
    }

    /**
     * Memproses pengembalian buku.
     */
    public function returnBook(Book $book)
    {
        if ($book->isAvailable()) {
            return back()->with('error', 'Buku ini sudah berada di inventaris.');
        }

        $book->markAsReturned();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dikembalikan ke inventaris.');
    }
}
