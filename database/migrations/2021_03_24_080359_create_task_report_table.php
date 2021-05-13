<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_report', function (Blueprint $table) {
            $table->id();
            $table->foreignId("task_id");
            $table->foreignId("user_id");
            $table->longText("task_details");
            $table->string("task_picture");
            $table->string("is_ce_approved")->default("false");
            $table->string("is_pm_approved")->default("false");
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
        Schema::dropIfExists('task_report');
    }
}
