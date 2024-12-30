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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'activity_logs_user_id'
            );
            $table->foreignId('product_id')->nullable()->constrained(
                table: 'products',
                indexName: 'activity_logs_product_id'
            );
            $table->string('product_name')->nullable();
            $table->string('action');
            $table->foreignId('category_id')->constrained(
                table: 'categories',
                indexName: 'activity_logs_category_id'
            );
            $table->string('details')->nullable();
            $table->timestamp('date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
