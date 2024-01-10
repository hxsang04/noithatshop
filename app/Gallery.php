<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = "galleries";

    protected $primaryKey = 'gallery_id';
    protected $guarded = [];
}
