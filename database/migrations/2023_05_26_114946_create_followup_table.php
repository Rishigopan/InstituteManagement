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
        Schema::create('followup', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('enquiry_id')->nullable()->default(0);
            $table->bigInteger('feedback_id')->nullable()->default(0);
            $table->string('remarks', 50)->nullable();
            $table->date('followup')->nullable();
            $table->bigInteger('staff_id')->nullable()->default(0);
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
        Schema::dropIfExists('followup');
    }
};
