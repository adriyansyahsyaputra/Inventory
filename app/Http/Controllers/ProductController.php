<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create() {
        // Mengambil semua data kategori untuk dropdown
        $categories = Category::all();
        return view('addProduct', compact('categories'));
    }

    public function store(Request $request) {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'stock' => 'required|numeric',
            'entry_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Mendapatkan kategori berdasarkan id
        $category = Category::find($validated['category_id']);

        // Menghasilkan kode produk menggunakan nama kategori
        $productCode = Product::generateProductCode($category->name);

        // Menyimpan gambar
        $pathImage = $request->file('image')->store('public/img/product');

        // Simpan data produk ke database
        Product::create([
            'product_code' => $productCode,
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'stock' => $validated['stock'],
            'entry_date' => $validated['entry_date'],
            'image' => $pathImage,
        ]);

        return redirect('/add-product')->with('success', 'Product created successfully.');
    }
}
