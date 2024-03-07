<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use app\Models\Order;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('payment_id')->nullable();
            $table->string('order_city')->nullable(false);
            $table->string('payment_type');
            $table->string('costumer_id')->nullable();
            $table->string('type')->nullable(false);
            $table->string('status');
            $table->float('shipping_amount')->nullable()->default(0);
            $table->float('total_amount')->nullable()->default(0);
            $table->bigInteger('coupon_id')->nullable();
            $table->string('obs')->nullable();
            $table->boolean('is_new')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
