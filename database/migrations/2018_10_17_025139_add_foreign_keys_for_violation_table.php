<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysForViolationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('violations', function(Blueprint $table) {
        $table->foreign('law_id')->references('id')->on('laws')
              ->onDelete('cascade')
              ->onUpdate('cascade');
        $table->foreign('user_id')->references('id')->on('users')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('violations', function(Blueprint $table) {
        $table->dropForeign('violations_user_id_foreign');
        $table->dropForeign('violations_law_id_foreign');
      });
    }
}
