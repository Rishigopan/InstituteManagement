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
        Schema::create('batches', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('branch_id')->nullable();
            $table->string('academic_year', 100)->nullable();
            $table->bigInteger('course_provider_id')->nullable();
            $table->string('course_name', 50)->nullable();
            $table->string('batch_name', 50)->nullable();
            $table->string('batch_no', 50)->nullable();
            $table->bigInteger('batch_type_id')->nullable();
            $table->integer('seat')->length(50)->default("0");
            $table->string('duration', 50)->nullable();
            $table->string('period', 50)->nullable();
            $table->string('session', 50)->nullable();
            $table->timestamp('startdate')->nullable(); 
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
        Schema::dropIfExists('batches');
    }
};
