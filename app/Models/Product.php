<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'product_code',
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'entry_date',
        'image',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Fungsi untuk membuat produk code
    public static function generateProductCode($categoryName): string {
        $prefix = strtoupper(substr($categoryName, 0, 3));
        $number = rand(100, 999);

        return $prefix . $number;
    }

    public function StockTransaction(): HasMany
    {
        return $this->hasMany(StockTransaction::class);
    }
}
