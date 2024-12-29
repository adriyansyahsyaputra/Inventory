<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\Auth;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with('category', 'user')->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {  
        $categories = Category::all();

        return view('transactions.create', compact('categories'));
    }

    public function recordTransaction(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'description' => 'required|string',
        ]);


        StockTransaction::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Transaksi Berhasil disimpan!');
    }
}
