<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('member_name');
            $table->string('slug')->unique();
            $table->string('designation');
            $table->string('mobile_number');
            $table->string('email_address');
            $table->text('address');
            $table->string('facebook_profile');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('profile_picture');
            $table->tinyInteger('publication_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
