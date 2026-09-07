<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Services\BookCatalogService;
use PHPUnit\Framework\TestCase;

class BookCatalogServiceTest extends TestCase
{
    private BookCatalogService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new BookCatalogService();
    }

    public function test_get_default_categories_returns_non_empty_array(): void
    {
        $categories = $this->service->getDefaultCategories();

        $this->assertIsArray($categories);
        $this->assertNotEmpty($categories);
        $this->assertContains('Rekayasa Perangkat Lunak', $categories);
        $this->assertContains('Basis Data', $categories);
    }

    public function test_book_model_availability_helper(): void
    {
        $book = new Book(['status' => 'tersedia']);
        $this->assertTrue($book->isAvailable());

        $book->status = 'dipinjam';
        $this->assertFalse($book->isAvailable());
    }
}
