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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('shipping_address_id')->after('total_amount');
            $table->unsignedBigInteger('billing_address_id')->after('shipping_address_id');
            $table->foreign('shipping_address_id')->references('id')->on('user_addresses');
            $table->foreign('billing_address_id')->references('id')->on('user_addresses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
