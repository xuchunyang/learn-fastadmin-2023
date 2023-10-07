<?php

namespace app\index\model;

use think\Model;

class Movie extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}