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
        Schema::create('castes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->bigInteger('religion_id')->nullable();
            $table->bigInteger('caste_category_id')->nullable();
            $table->string('remarks')->nullable()->default("");
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
        Schema::dropIfExists('castes');
    }
};
