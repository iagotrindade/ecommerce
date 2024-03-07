<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProductAddons;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('purchased_product_addons', function (Blueprint $table) {
            $table->foreignIdFor(ProductAddons::class)->references('id')->on('product_addons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchased_product_addons', function (Blueprint $table) {
            $table->dropForeignIdFor(ProductAddons::class);
        });
    }
};
