<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function posts(){
//        hasOne, hasMany, belongsTo, belongsToMany
        return $this->hasMany(Post::class);
    }
}
