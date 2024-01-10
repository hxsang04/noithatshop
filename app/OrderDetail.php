<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";

    protected $primaryKey = 'order_detail_id';
    protected $guarded = [];

    public function detailorderpro(){
        return $this->belongsTo('App\Product','product_id');
    }
}
