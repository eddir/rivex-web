<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bug_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('body');
            $table->tinyInteger('type')->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('bug_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->
                onDelete('restrict')->onUpdate('restrict');
            $table->foreign('bug_id')->references('id')->on('bugs')->
                onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bug_comments');
    }
}
