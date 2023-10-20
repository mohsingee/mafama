<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthplaceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birthplace_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid'); //uploaded by
            $table->string('by_admin_status')->default(0);
            $table->string('text_input');
            $table->string('banner_url');
            $table->string('video_url');
            $table->string('banner_title');
            $table->string('video_title');

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
        Schema::dropIfExists('birthplace_details');
    }
}