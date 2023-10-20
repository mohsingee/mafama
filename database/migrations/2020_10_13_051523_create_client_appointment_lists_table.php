<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientAppointmentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_appointment_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('address');
            $table->string('zip_code');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('dob');
            $table->string('home_phone');
            $table->string('work_phone');
            $table->string('cell_phone');
            $table->string('password');
            $table->string('company');
            $table->string('comment');
            $table->string('religion');
            $table->string('category1');
            $table->string('category2');
            $table->string('uid');
            $table->string('image');
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
        Schema::dropIfExists('client_appointment_lists');
    }
}
