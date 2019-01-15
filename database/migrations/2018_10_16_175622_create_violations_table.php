<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('violations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('location', 20);
            $table->string('violator', 64);
            $table->integer('user_id')->unsigned();
            $table->integer('law_id')->unsigned();
            $table->text('cause');
            $table->datetime('term_start');
            $table->datetime('term_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('violations');
    }
}
