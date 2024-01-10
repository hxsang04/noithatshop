<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryBlog extends Model
{
    protected $table = "category_blogs";

    protected $primaryKey = 'category_blog_id';
    protected $guarded = [];

    public function CateBlog(){
    	return $this->hasMany('App\Blog','category_blog_id');
    }
}
