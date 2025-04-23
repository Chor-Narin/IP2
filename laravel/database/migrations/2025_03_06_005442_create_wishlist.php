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
        Schema::create('wishlist', function (Blueprint $table) {
            $table->id();
            $table->bigInteger(column:'product_id')->unsigned();
            $table->bigInteger(column:'customer_id')->unsigned();
            $table->timestamps();

            $table->foreign(columns:'product_id') ->references(columns:'id')->on(table:'products');
            $table->foreign(columns:'customer_id') ->references(columns:'id')->on(table:'customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
};
