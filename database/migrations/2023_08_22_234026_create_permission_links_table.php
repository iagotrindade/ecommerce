<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PermissionLinks;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permission_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permission_group_id');

            $table->foreign('permission_group_id')->references('id')->on('permission_groups')->onDelete('cascade');

            $table->unsignedBigInteger('permission_item_id');

            $table->foreign('permission_item_id')->references('id')->on('permission_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('permission_links', function(Blueprint $table) {
            $table->dropForeign('permission_group_id');
            $table->dropForeign('permission_item_id');
        });

        Schema::dropIfExists('permission_links');
    }
};
