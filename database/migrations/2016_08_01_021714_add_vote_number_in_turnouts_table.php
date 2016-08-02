<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVoteNumberInTurnoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('turnouts', function (Blueprint $table) {
            foreach(range(1,10) as $number){
                $table->integer('vote'.$number)->after('fileName'.$number);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('turnouts', function (Blueprint $table) {
            foreach(range(1,10) as $number){
                $table->dropColumn('vote'.$number);
            }
        });
    }
}
