<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFileNameToNullInTurnoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('turnouts', function (Blueprint $table) {
            for($i = 0 ; $i < 10; $i++){
                $table->string('fileName'.($i+1),50)->nullable()->change();
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
            for($i = 0 ; $i < 10; $i++){
                $table->string('fileName'.($i+1),50)->change();
            }
        });
    }
}
