<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_index_page_is_accessible(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Katalog Buku &amp; Referensi Kuliah', false);
        $response->assertSee('Total Buku');
    }

    public function test_user_can_create_a_new_book(): void
    {
        $payload = [
            'judul' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
            'penulis' => 'Robert C. Martin',
            'tahun' => 2008,
            'kategori' => 'Rekayasa Perangkat Lunak',
        ];

        $response = $this->post('/books', $payload);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('books', [
            'judul' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
            'status' => 'tersedia',
            'peminjam' => null,
        ]);
    }

    public function test_book_creation_requires_mandatory_fields(): void
    {
        $response = $this->post('/books', []);

        $response->assertSessionHasErrors(['judul', 'penulis', 'tahun', 'kategori']);
    }

    public function test_user_can_borrow_an_available_book(): void
    {
        $book = Book::create([
            'judul' => 'Refactoring',
            'penulis' => 'Martin Fowler',
            'tahun' => 2018,
            'kategori' => 'Rekayasa Perangkat Lunak',
            'status' => 'tersedia',
        ]);

        $response = $this->post("/books/{$book->id}/borrow", [
            'peminjam' => 'Ahsani Fadhli Ilahi',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'status' => 'dipinjam',
            'peminjam' => 'Ahsani Fadhli Ilahi',
        ]);
    }

    public function test_user_cannot_borrow_already_borrowed_book(): void
    {
        $book = Book::create([
            'judul' => 'Design Patterns',
            'penulis' => 'Gang of Four',
            'tahun' => 1994,
            'kategori' => 'Rekayasa Perangkat Lunak',
            'status' => 'dipinjam',
            'peminjam' => 'Budi',
        ]);

        $response = $this->post("/books/{$book->id}/borrow", [
            'peminjam' => 'Citra',
        ]);

        $response->assertSessionHas('error');
        $this->assertEquals('Budi', $book->fresh()->peminjam);
    }

    public function test_user_can_return_a_borrowed_book(): void
    {
        $book = Book::create([
            'judul' => 'Pragmatic Programmer',
            'penulis' => 'Andrew Hunt',
            'tahun' => 1999,
            'kategori' => 'Rekayasa Perangkat Lunak',
            'status' => 'dipinjam',
            'peminjam' => 'Ahsani Fadhli Ilahi',
        ]);

        $response = $this->post("/books/{$book->id}/return");

        $response->assertRedirect('/');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'status' => 'tersedia',
            'peminjam' => null,
        ]);
    }

    public function test_user_can_search_books_by_title_or_author(): void
    {
        Book::create([
            'judul' => 'Sistem Basis Data Lanjut',
            'penulis' => 'Fathansyah',
            'tahun' => 2020,
            'kategori' => 'Basis Data',
        ]);

        Book::create([
            'judul' => 'Arsitektur Komputer Modern',
            'penulis' => 'Andrew S. Tanenbaum',
            'tahun' => 2016,
            'kategori' => 'Jaringan & Keamanan',
        ]);

        $response = $this->get('/?search=Fathansyah');

        $response->assertStatus(200);
        $response->assertSee('Sistem Basis Data Lanjut');
        $response->assertDontSee('Arsitektur Komputer Modern');
    }

    public function test_user_can_filter_books_by_category(): void
    {
        Book::create([
            'judul' => 'Deep Learning with Python',
            'penulis' => 'Francois Chollet',
            'tahun' => 2021,
            'kategori' => 'Kecerdasan Buatan',
        ]);

        Book::create([
            'judul' => 'Struktur Data C++',
            'penulis' => 'Adam Drozdek',
            'tahun' => 2012,
            'kategori' => 'Struktur Data & Algoritma',
        ]);

        $response = $this->get('/?kategori=Kecerdasan+Buatan');

        $response->assertStatus(200);
        $response->assertSee('Deep Learning with Python');
        $response->assertDontSee('Struktur Data C++');
    }
}
