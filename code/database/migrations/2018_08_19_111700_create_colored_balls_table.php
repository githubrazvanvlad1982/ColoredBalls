<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColoredBallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colored_balls_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_model_id', false, true);
            $table->smallInteger('color', false, true);
            $table->smallInteger('number', false, true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colored_balls');
    }
}
