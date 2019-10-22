<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameLobbiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_lobbies', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            
            $table->bigInteger('current_player')->nullable()->unsigned();
            $table->foreign('current_player')->references('id')->on('users');
            
            $table->dateTime('start_at')->nullable();
            $table->dateTime('stop_at')->nullable();

            $table->mediumText('data');

            $table->timestamps();
        });

        Schema::create('game_lobby_user', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->tinyInteger('status')->default(0);

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
        Schema::dropIfExists('game_lobby_user');
        Schema::dropIfExists('game_lobbies');
    }
}
