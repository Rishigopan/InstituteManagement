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
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('course_provider_id')->nullable();
            $table->string('code', 100)->nullable();
            $table->string('course_name', 120)->nullable();
            $table->string('printable_name', 120)->nullable();
            $table->string('batch_course', 50)->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('course_category_id')->nullable();
            $table->bigInteger('course_type_id')->nullable();
            $table->string('zonal_discount', 50)->nullable();
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
        Schema::dropIfExists('courses');
    }
};
