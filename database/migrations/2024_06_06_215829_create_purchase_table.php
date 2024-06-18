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
        Schema::create('purchase', function (Blueprint $table) {
            $table->increments('id_purchase');
            $table->integer('id_supplier');
            $table->integer('total_items');
            $table->integer('total_price');
            $table->tinyInteger('discount')->default(0);
            $table->integer('pay')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase');
    }
};
