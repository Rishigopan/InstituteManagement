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
        Schema::create('ObserverORparticipate', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('assigntask_id')->nullable();
            $table->string('type')->default('50')->nullable();
            $table->string('observer_id')->nullable();
            $table->string('participate_id')->nullable();
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
        Schema::dropIfExists('ObserverORparticipate');
    }
};
