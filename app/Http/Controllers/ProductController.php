<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $products =
            Product::with('category')->get();
        $categories = Category::all();

        // Fungsi search
        if (request('search')) {
            $products = Product::where('name', 'like', '%' . request('search') . '%')
            ->orWhere('product_code', 'like', '%' . request('search') . '%')
            ->get();
        }

        if (request('category')) {
            $products = Product::where('category_id', request('category'))->get();
        }

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
            $product = Product::create([
                'product_code' => $productCode,
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'stock' => $validated['stock'],
                'entry_date' => $validated['entry_date'],
                'image' => $imagePath,
            ]);

            // Log activity - Menambahkan produk baru
            ActivityLog::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'action' => 'created',
                'category_id' => $validated['category_id'],
                'details' => 'Product ' . $validated['name'] . ' has been created.',
                'date' => now(),
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
        $product = Product::findOrFail($id);

        // Log activity - Menghapus produk
        ActivityLog::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'product_name' => $product->name,
            'action' => 'deleted',
            'category_id' => $product->category_id,
            'details' => "Product {$product->name} has been deleted",
            'date' => now()
        ]);

        // Hapus gambar jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
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

        // Menyimpan data lama untuk mencatat perubahan
        $oldProduct = $product->getOriginal();

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

        // Menyusun detail perubahan untuk Activity Log
        $changedAttributes = $product->getDirty(); // Kolom yang berubah
        $details = 'Updated: ' . $product->name . '. Changes: ';

        // Memasukkan perubahan atribut yang berubah ke dalam detail log
        foreach ($changedAttributes as $attribute => $newValue) {
            $oldValue = $oldProduct[$attribute] ?? 'N/A'; // Nilai lama, jika ada
            $details .= ucfirst($attribute) . ' changed from "' . $oldValue . '" to "' . $newValue . '", ';
        }

        // Menghilangkan koma terakhir
        $details = rtrim($details, ', ');

        // Log activity - Memperbarui produk
        ActivityLog::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'action' => 'updated',
            'category_id' => $product->category_id,
            'details' => $details,
            'date' => now(),
        ]);

        return redirect()->route('products.table')->with('success', 'Product updated successfully');
    }
}
