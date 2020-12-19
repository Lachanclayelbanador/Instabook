<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");

            $table->date("date")->nullable();;

            $table->binary("file");
            $table->string("resolution")->nullable();
            $table->string("width")->nullable();
            $table->string("height")->nullable();

            $table->foreignId("group_id")->constrained()->onDelete('cascade');
            $table->foreignId("user_id")->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('photos');
    }
}
