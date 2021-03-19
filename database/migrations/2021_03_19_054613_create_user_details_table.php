<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string("user_position");
            $table->string("user_status");
            $table->string("user_degree");
            $table->string("user_contact_number");
            $table->text("user_current_address");
            $table->text("user_address");
            $table->string("user_gender");
            $table->string("user_birthday");
            $table->string("user_place_of_birth");
            $table->string("user_civil_status");
            $table->string("user_height")->default("none");
            $table->string("user_weight")->default("none");
            $table->string("user_religion");
            $table->string("user_elementary")->default("none");
            $table->string("user_highschool")->default("none");
            $table->string("user_college")->default("none");
            $table->string("user_sss")->default("none");
            $table->string("user_tin")->default("none");
            $table->string("user_nbi")->default("none");
            $table->string("user_passport")->default("none");
            $table->string("user_rate");
            $table->string("user_income");
            $table->foreignId("user_id");
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
        Schema::dropIfExists('user_details');
    }
}
