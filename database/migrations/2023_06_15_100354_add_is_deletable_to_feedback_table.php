<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('_feedback', function (Blueprint $table) {
        $table->string('is_deletable')->nullable()->default('YES');
        });
         // Insert some stuff
    DB::table('_feedback')->insert(
        array(
            'id' =>'1',
            'feedback' => 'closed',
            'is_deletable' => 'NO'
        )
        
    );
    DB::table('_feedback')->insert(
        array(
            'id' =>'2',
            'feedback' => 'Joined Other/Not interest',
            'is_deletable' => 'NO'
        )
        
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_feedback', function (Blueprint $table) {
            //
        });
    }
};
