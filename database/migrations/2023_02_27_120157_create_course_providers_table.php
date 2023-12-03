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
        Schema::create('course_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider_name', 50);
            $table->string('id_card_prefix', 25);
            $table->string('code', 50);
            $table->string('permanent_address', 500)->nullable();
            $table->string('permanent_mobile_no',15)->nullable();
            $table->string('permanent_lan_line_no',15)->nullable();
            $table->string('permanent_email', 50)->nullable();
            $table->string('permanent_post_office', 50)->nullable();
            $table->string('permanent_lan_mark', 50)->nullable();
            $table->string('communication_address', 500)->nullable();
            $table->string('communication_mobile_no',15)->nullable();
            $table->string('communication_lan_line_no',15)->nullable();
            $table->string('communication_email', 50)->nullable();
            $table->string('communication_post_office', 50)->nullable();
            $table->string('communication_lan_mark', 50)->nullable();
            $table->string('gst_no', 50)->nullable();
            $table->string('pan_no', 50)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('location', 50)->nullable();
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
        Schema::dropIfExists('course_providers');
    }
};
