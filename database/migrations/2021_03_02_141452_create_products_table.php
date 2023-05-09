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
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('ultra_sub_category_id')->nullable();
            $table->string('product_name');
            $table->string('product_color')->nullable();
            $table->string('user_name');
            $table->string('slug')->unique();
            $table->float('product_price_regular',10,2);
            $table->float('product_price_discount',10,2)->nullable();
            $table->integer('product_quantity');
            $table->text('short_description');
            $table->text('long_description')->nullable();
            $table->integer('inside_dhaka')->default(75);
            $table->integer('outside_dhaka')->default(130);
            $table->text('product_image');
            $table->tinyInteger('publication_status');
            $table->tinyInteger('boost_status')->default(0);
            $table->tinyInteger('special_offer')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('ultra_sub_category_id')->references('id')->on('ultra_sub_cats')->onDelete('cascade');
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
