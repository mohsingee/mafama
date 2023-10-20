<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('joining_date');
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('religion');
            $table->string('email');
            $table->string('cellphone');
            $table->string('business_telephone');
            $table->string('business_category');
            $table->string('image');
            $table->string('address');
            $table->string('zip_code');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('billing_address');
            $table->string('billing_zip_code');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_country');
            $table->string('sponsor_id');
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
        Schema::dropIfExists('affiliate_registrations');
    }
}
