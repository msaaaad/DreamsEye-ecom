<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId');
            $table->string('company_name');
            $table->string('slug')->unique();
            $table->text('bill_address');
            $table->text('tin_certificate');
            $table->text('varification');
            $table->text('emergency_contact');
            $table->tinyInteger('seller_status')->default(0);
            $table->timestamps();
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
