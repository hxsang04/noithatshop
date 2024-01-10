<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";

    protected $primaryKey = 'cart_id';
    protected $guarded = [];


    public function getCart(){
        $carts = Cart::join('products','carts.product_id','products.product_id')->where([['cart_status',1],['user_id',Auth::id()]])->get();
        return $carts;
    }
}
