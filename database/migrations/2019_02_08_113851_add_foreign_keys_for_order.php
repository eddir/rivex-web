<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysForOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function(Blueprint $table) {
          $table->foreign('server_id')->references('id')->on('servers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
          $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
          $table->foreign('coupon_id')->references('id')->on('coupons')
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
        Schema::table('orders', function(Blueprint $table) {
          $table->dropForeign('orders_coupon_id_foreign');
          $table->dropForeign('orders_product_id_foreign');
          $table->dropForeign('orders_server_id_foreign');
        });
    }
}
