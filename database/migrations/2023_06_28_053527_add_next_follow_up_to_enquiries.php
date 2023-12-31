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
        Schema::table('enquiries', function (Blueprint $table) {
            $table->date('next_folow_up')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

        public function down()
        {
            Schema::table('enquiries', function (Blueprint $table) {
                $table->dropColumn('next_folow_up');
            });
        
    }
};
