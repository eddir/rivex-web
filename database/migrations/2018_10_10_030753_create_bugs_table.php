<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title', 100);
            $table->text('body');
            $table->integer('user_id')->unsigned();
            $table->integer('confirm_user_id')->unsigned()->nullable();
            $table->integer('bug_important')->unsigned();
            $table->integer('bug_type')->unsigned();
            $table->boolean('active')->default(false);
            $table->tinyinteger('progress');

            $table->foreign('user_id')->references('id')->on('users')
					            	->onDelete('restrict')
					            	->onUpdate('restrict');
            $table->foreign('confirm_user_id')->references('id')->on('users')
					            	->onDelete('restrict')
					            	->onUpdate('restrict');
            $table->foreign('bug_important')->references('id')->on('bug_importants')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
            $table->foreign('bug_type')->references('id')->on('bug_types')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
		    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bugs');
    }
}
