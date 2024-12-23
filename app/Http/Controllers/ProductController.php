<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create()
    {
        // Mengambil semua data kategori untuk dropdown
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        
        return view('products.table', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        try {
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

            $imagePath = $request->hasFile('image')
                ? $request->file('image')->store('products', 'public')
                : null;

            // Simpan data produk ke database
            Product::create([
                'product_code' => $productCode,
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'stock' => $validated['stock'],
                'entry_date' => $validated['entry_date'],
                'image' => $imagePath,
            ]);

            return redirect()->route('products')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            // Jika terjadi error, hapus file yang sudah terupload (jika ada)
            if (isset($imagePath) && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.table')->with('error', 'Product not found');
        }

        // Hapus gambar jika ada
        if ($product->image && file_exists(public_path('storage/' . $product->image))) {
            unlink(public_path('storage/' . $product->image));
        }

        $product->delete();

        return redirect()->route('products.table')->with('success', 'Product deleted successfully');
    }

    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.table')->with('error', 'Product not found');
        }

        // Mengambil semua data kategori untuk dropdown
        $categories = Category::all();

        return view('products.update', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.table')->with('error', 'Product not found');
        }

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'stock' => 'required|numeric|min:1', // validasi stock agar minimal 1
            'entry_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // gambar tidak wajib
        ]);

        // Update data produk
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->entry_date = $request->entry_date;

        // Cek jika kategori berubah, maka update product_code
        if ($product->category_id != $request->category_id) {
            $product->category_id = $request->category_id;

            // Ambil nama kategori baru yang dipilih
            $categoryName = Category::find($request->category_id)->name;

            // Gunakan nama kategori untuk generate product_code
            $product->product_code = Product::generateProductCode($categoryName);
        }

        // Update gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                unlink(public_path('storage/' . $product->image));
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Simpan perubahan ke database
        $product->save();

        return redirect()->route('products.table')->with('success', 'Product updated successfully');
    }
}
