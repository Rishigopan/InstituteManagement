<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('student_id')->nullable();
            $table->string('academic_year', 50)->nullable();
            $table->string('admission_no', 50)->nullable();
            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('batch_id')->nullable();
            $table->dateTime('join_date')->nullable();
            $table->dateTime('complete_date')->nullable();
            $table->string('id_no', 50)->nullable();
            $table->string('reg_no', 50)->nullable();
            $table->integer('roll_no')->length(50)->default("0");
            $table->string('email', 120)->nullable();
            $table->string('fee_plan', 50)->nullable();
            $table->integer('special_discount')->length( 50)->default("0");
            $table->integer('created_by')->length(11)->default("0");
            $table->integer('updated_by')->length(11)->default("0");
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
        Schema::dropIfExists('admissions');
    }
};
