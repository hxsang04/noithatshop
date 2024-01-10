<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blogs";

    protected $primaryKey = 'blog_id';
    protected $guarded = [];

    public function blog_user(){
    	return $this->belongsTo('App\User','user_id');
    }
    public function blog_cate(){
    	return $this->belongsTo('App\CategoryBlog','category_blog_id');
    }
}
