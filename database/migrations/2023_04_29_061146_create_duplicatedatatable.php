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
        Schema::create('duplicatedatatable', function (Blueprint $table) {
          $table->increments('id');
            $table->string('name', 50);
            $table->string('gender')->default(false);
            $table->date('dob')->nullable();
            $table->bigInteger('parent_info_id')->nullable()->default(0);
            $table->bigInteger('religion_id')->nullable()->default(0);
            $table->bigInteger('staff_id')->nullable()->default(0);
            $table->bigInteger('caste_id')->nullable()->default(0);
            $table->string('education', 100)->nullable();
            $table->bigInteger('stream_id')->nullable()->default(0);
            $table->bigInteger('branch_id')->nullable()->default(0);
            $table->string('colg_schl', 100)->nullable();
            $table->string('photo', 100)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('location', 50)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('pincode', 50)->nullable();
            $table->string('mob_no', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->timestamp('enq_date')->nullable();
            $table->bigInteger('course_id')->nullable()->default(0);
            $table->string('discount', 50)->nullable();
            $table->string('enq_source', 50)->nullable()->default(0);
            $table->string('enq_stage', 50)->nullable();
            $table->string('remarks', 50)->nullable();
            $table->string('next_folow_up', 50)->nullable();
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
        Schema::dropIfExists('duplicatedatatable');
    }
};
