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
        Schema::table('product_carts', function (Blueprint $table) {
            if (!Schema::hasColumn('product_carts', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }

            if (!Schema::hasColumn('product_carts', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_carts', function (Blueprint $table) {
            if (Schema::hasColumn('product_carts', 'product_id')) {
                $table->dropColumn('product_id');
            }

            if (Schema::hasColumn('product_carts', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};


