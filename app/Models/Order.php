<?php

namespace App\Models;

use App\Models\{
    Product,
    Server,
    Coupon
};

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'status', 'username', 'email', 'amount', 'server_id', 'product_id', 'coupon_id'
     ];

     /**
      * One to Many relation
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function product()
     {
         return $this->belongsTo(Product::class);
     }

     /**
      * One to Many relation
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function server()
     {
         return $this->belongsTo(Server::class);
     }

     /**
      * One to Many relation
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function coupon()
     {
         return $this->belongsTo(Coupon::class);
     }
}
