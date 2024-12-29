<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained(
                table: 'categories',
                indexName: 'stock_transactions_category_id'
            )->onDelete('cascade');
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'stock_transactions_user_id'
            )->onDelete('cascade');
            $table->enum('type', ['in', 'out']);
            $table->integer('quantity');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};
