<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnouts', function (Blueprint $table) {
            $table->increments('id');
            $table->char('item',50);
            $table->integer('votes');
            for($i = 0 ; $i < 10; $i++){
                $table->char('optionName'.($i+1),50);
                $table->char('fileName'.($i+1),50);
            }
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
        Schema::drop('turnouts');
    }
}
