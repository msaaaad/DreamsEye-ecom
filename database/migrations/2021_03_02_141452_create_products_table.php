<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('product_name');
            $table->float('product_price_regular',10,2);
            $table->float('product_price_discount',10,2);
            $table->integer('product_quantity');
            $table->text('short_description');
            $table->text('long_description');
            $table->text('product_image');
            $table->tinyInteger('publication_status');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->casecadeOnDelete();
            $table->foreign('brand_id')->references('id')->on('brands')->casecadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
