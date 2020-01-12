<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class
CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->text('complaints')->nullable();
            $table->text('complaints_unique')->nullable();
            $table->text('location')->nullable();
            $table->dateTimeTz('expected_date')->nullable();
            $table->text('priority')->nullable();
            $table->text('maerials')->nullable();
            $table->text('work_status')->nullable();
            $table->text('isCancelled')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
//
//            $table->foreign('employee_id')->references('id')->on('employee');
//            $table->foreign('user_id')->references('id')->on('users');
            $table->text('image')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('complaints');
    }
}
