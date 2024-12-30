<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\Auth;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with('category', 'user')->get();

        // Data for Card
        $totalTransactions = $transactions->count();
        $totalIn = $transactions->where('type', 'in')->sum('quantity');
        $totalOut = $transactions->where('type', 'out')->sum('quantity');
        $totalProducts = Product::count();

        // Data for Graphic
        $chartData = [
            'labels' => ['Barang Masuk', 'Barang Keluar'],
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi',
                    'backgroundColor' => ['#36A2EB', '#FF6384'],
                    'data' => [$totalIn, $totalOut]
                ]
            ]
        ];

        return view('transactions.index', compact('transactions', 'totalTransactions', 'totalIn', 'totalOut', 'totalProducts', 'chartData'));
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
