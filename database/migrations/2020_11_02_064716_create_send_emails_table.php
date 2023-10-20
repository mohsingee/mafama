<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('campaign_name');
            $table->string('subject');
            $table->string('image');
            $table->string('backhground');
            $table->string('message');
            $table->string('date');
            $table->string('status');
            $table->longText('user_banner');
            $table->string('time');
            $table->string('uid');
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
        Schema::dropIfExists('send_emails');
    }
}
