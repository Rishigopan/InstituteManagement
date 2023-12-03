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
        Schema::create('_stream', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('qualification_id')->nullable();
            $table->string('stream')->nullable()->default("");
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
        Schema::dropIfExists('_stream');
    }
};
