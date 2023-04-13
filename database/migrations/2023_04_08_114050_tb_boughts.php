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
        Schema::create('tb_boughts', function (Blueprint $table) {
            $table->id('bought_id');

            $table->unsignedBigInteger('bought_user');
            $table->foreign('bought_user')->references('user_id')->on('tb_users');

            $table->unsignedBigInteger('bought_product');
            $table->foreign('bought_product')->references('product_id')->on('tb_products');

            $table->integer('bought_qnt')->default(1);

            $table->string('shopping_order_status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_boughts');
    }
};
