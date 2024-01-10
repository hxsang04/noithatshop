<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $primaryKey = 'category_id';
    protected $guarded = [];

    public function CatePro(){
    	return $this->hasMany('App\Product','category_id');
    }
}
