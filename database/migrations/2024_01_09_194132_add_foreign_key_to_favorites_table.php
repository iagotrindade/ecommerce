<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->references('id')->on('users')->onDelete('cascade');
            $table->foreignIdFor(Product::class)->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropForeignIdFor(Product::class);
        });
    }
};
