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
        Schema::create('_checklist_details', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('assigntask_id')->nullable();
            $table->bigInteger('task_id')->nullable();
            $table->bigInteger('checklist_id')->nullable();
            $table->string('checklist_name')->nullable()->default("");
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->time('total_time')->nullable();
            $table->string('completed_status')->nullable()->default("");
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
        Schema::dropIfExists('_checklist_details');
    }
};
