<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGenerateProductCode() {
        // nama kategori
        $categoryName = 'Laptop';

        // Jalankan fungsi generateProductCode
        $result = Product::generateProductCode($categoryName);

        // Ambil 3 huruf pertama dari nama kategori dan tahun
        $prefix = strtoupper(substr($categoryName, 0, 3));
        $year = date('y');
        $expectedCode = $prefix . $year;

        // Periksa hasil
        $this->assertEquals($expectedCode, $result);
    }
}
