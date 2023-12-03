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
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organization_name',50);
            $table->string('code', 100)->nullable();
            $table->string('permanent_address', 500)->nullable();
            $table->bigInteger('permanent_mobile_no')->length(30)->nullable()->default(0);
            $table->bigInteger('permanent_lan_line_no')->length(30)->nullable()->default(0);
            $table->string('permanent_email', 120)->nullable();
            $table->string('permanent_post_office', 50)->nullable();
            $table->string('permanent_lan_mark', 120)->nullable();
            $table->string('communication_address', 500)->nullable();
            $table->bigInteger('communication_mobile_no')->length(30)->nullable()->default(0);
            $table->bigInteger('communication_lan_line_no')->length(30)->nullable()->default(0);
            $table->string('communication_email', 120)->nullable();
            $table->string('communication_post_office', 50)->nullable();
            $table->string('communication_lan_mark', 120)->nullable();
            $table->string('gst_no', 30)->nullable();
            $table->string('pan_no', 30)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('location', 50)->nullable();
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
        Schema::dropIfExists('organizations');
    }
};
