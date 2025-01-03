<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with(['user', 'product', 'category'])->latest()->paginate(10);

        return view('activity.index', compact('logs'));
    }

    public function storeLog(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'action' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'details' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $product = Product::find($request->product_id);
        if (!$product) {
            return redirect()->back()->withErrors(['product_id' => 'Produk tidak ditemukan']);
        }   

        // Simpan data ke database
        ActivityLog::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'product_name' => $product->name,
            'action' => $request->action,
            'category_id' => $request->category_id,
            'details' => $request->details,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
