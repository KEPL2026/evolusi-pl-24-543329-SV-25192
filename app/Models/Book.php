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

    /**
     * Scope untuk pencarian berdasarkan judul atau penulis.
     */
    public function scopeSearch($query, ?string $keyword)
    {
        if (! empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('penulis', 'like', "%{$keyword}%");
            });
        }
        return $query;
    }

    /**
     * Scope untuk filter berdasarkan kategori buku.
     */
    public function scopeCategory($query, ?string $category)
    {
        if (! empty($category)) {
            $query->where('kategori', $category);
        }
        return $query;
    }
}
