<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('members');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->char('account',50);
            $table->char('phone',10);
            $table->char('studentID',8);
            $table->char('super_user',1);
            $table->timestamps();
        });
    }
}
