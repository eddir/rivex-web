<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->decimal('amount', 8, 2);
            $table->string('username', 255);
            $table->string('email');
            $table->integer('server_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('coupon_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
