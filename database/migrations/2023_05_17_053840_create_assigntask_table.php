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
        Schema::create('assigntask', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('task_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->date('date')->nullable();
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->time('task_start_time')->nullable();
            $table->time('task_end_time')->nullable();
            $table->time('total_time')->nullable();
            $table->string('file')->nullable();
            $table->string('completed_status')->nullable()->default("0");
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
        Schema::dropIfExists('assigntask');
    }
};
