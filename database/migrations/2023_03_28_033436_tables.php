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
        
        #CRIANDO A TABELA DE PRODUTOS PELO ARTISAN MIGRATE
        Schema::create('tb_products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->float('product_price',8,2);
            $table->text('product_description')->nullable();
            $table->string('product_uri');
            $table->string('product_image');
            $table->timestamps();
        });

        #CRIANDO A TABELA DE CARRINHOS PELO ARTISAN
        Schema::create('tb_carts', function (Blueprint $table){
            $table->id('cart_id');

            #fazendo a foreign key do id user para linkar carrinho c user
            $table->unsignedBigInteger('cart_user');
            $table->foreign('cart_user')->references('user_id')->on('tb_users')->onDelete('no action')->onUpdate('no action');

            $table->timestamps();
        });

        #CRIANDO A TABELA DE COMPRAS PELO ARTISAN
        Schema::create('tb_shoppings', function (Blueprint $table){
            $table->id('shopping_id');

            $table->unsignedBigInteger('shopping_cart');
            $table->unsignedBigInteger('shopping_product');

            #foreign key do carrinho do usuario que fez a compra
            $table->foreign('shopping_cart')->references('cart_id')->on('tb_carts')->onDelete('no action')->onUpdate('no action');
            
            #foreign key do produto comprado
            $table->foreign('shopping_product')->references('product_id')->on('tb_products')->onDelete('no action')->onUpdate('no action');

            $table->timestamp('shopping_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_users');
        Schema::dropIfExists('tb_products');
        Schema::dropIfExists('tb_carts');
        Schema::dropIfExists('tb_shoppings');
    }
};
