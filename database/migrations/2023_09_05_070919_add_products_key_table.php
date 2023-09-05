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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_featured')->after('quantity')->default(false);
            $table->boolean('is_popular')->after('is_featured')->default(false);
            $table->boolean('is_new_arrival')->after('is_popular')->default(false);
            $table->boolean('is_top_selling')->after('is_new_arrival')->default(false);
            $table->boolean('is_discounted_deal')->after('is_top_selling')->default(false)->nullable();
            $table->boolean('is_active')->after('is_discounted_deal')->default(true);
            $table->unsignedBigInteger('thumbnail_id')->after('is_active')->nullable();
            $table->foreign('thumbnail_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
