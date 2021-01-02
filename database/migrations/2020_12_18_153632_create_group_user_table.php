<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->unique(['group_id','user_id']);
            $table->foreign('group_id')->references('id')->on('groups')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->engine = "InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_users');
    }
}
