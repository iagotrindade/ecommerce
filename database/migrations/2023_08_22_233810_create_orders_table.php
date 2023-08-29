<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use app\Models\Order;
use App\Models\Client;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(false);
            $table->string('client_name')->nullable(false);
            $table->string('order_city')->nullable(false);
            $table->string('payment_type');
            $table->string('payment_status');
            $table->string('processing_status');
            $table->float('total_amount')->nullable()->default(0);
            $table->bigInteger('coupon_id');
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
