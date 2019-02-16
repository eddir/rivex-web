<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laws', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('location', 20);
            $table->string('title');
            $table->text('description');
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::table('laws', function(Blueprint $table) {
          $table->dropForeign('laws_user_id_foreign');
        });
        Schema::dropIfExists('laws');
    }
}
