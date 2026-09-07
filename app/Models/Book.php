<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'tahun',
        'kategori',
        'status',
        'peminjam',
    ];

    /**
     * Memeriksa apakah buku sedang tersedia.
     */
    public function isAvailable(): bool
    {
        return $this->status === 'tersedia';
    }

    /**
     * Meminjam buku kepada seseorang.
     */
    public function borrowTo(string $namaPeminjam): void
    {
        $this->update([
            'status' => 'dipinjam',
            'peminjam' => trim($namaPeminjam),
        ]);
    }

    /**
     * Mengembalikan buku ke inventaris.
     */
    public function markAsReturned(): void
    {
        $this->update([
            'status' => 'tersedia',
            'peminjam' => null,
        ]);
    }
}
