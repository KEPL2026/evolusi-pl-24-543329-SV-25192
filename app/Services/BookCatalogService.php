<?php

namespace App\Services;

use App\Models\Book;

class BookCatalogService
{
    /**
     * Daftar kategori default untuk referensi kuliah.
     *
     * @return array<int, string>
     */
    public function getDefaultCategories(): array
    {
        return [
            'Rekayasa Perangkat Lunak',
            'Basis Data',
            'Jaringan & Keamanan',
            'Kecerdasan Buatan',
            'Struktur Data & Algoritma',
            'Umum / Referensi',
        ];
    }

    /**
     * Menghitung statistik inventaris katalog buku.
     *
     * @return array{total: int, tersedia: int, dipinjam: int}
     */
    public function getStatistics(): array
    {
        $total = Book::count();
        $tersedia = Book::where('status', 'tersedia')->count();
        $dipinjam = Book::where('status', 'dipinjam')->count();

        return [
            'total' => $total,
            'tersedia' => $tersedia,
            'dipinjam' => $dipinjam,
        ];
    }
}
