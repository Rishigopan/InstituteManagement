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
        Schema::table('taskstatus', function (Blueprint $table) {
            $table->string('is_deletable')->nullable()->default('YES');
        });
         // Insert some stuff
    DB::table('taskstatus')->insert(
        array(
            'id' =>'1',
            'taskstatus' => 'pending',
            'is_deletable' => 'NO'
        )
        
    );
    DB::table('taskstatus')->insert(
        array(
            'id' =>'2',
            'taskstatus' => 'completed',
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
        Schema::table('taskstatus', function (Blueprint $table) {
            //
        });
    }
};
