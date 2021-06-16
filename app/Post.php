<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    use HasFactory;

//    Guarded Property
//    Everything can be edited except for the params and in this case ['id'] is protected.
    protected $guarded = [];

//    Fillable Property
//    Everything included in the param is vulnerable to being edited except the ones not mentioned.
//    In this case  ['title', 'excerpt', 'body', 'id'] are the exception of edit-able params.
//    protected $fillable = ['title', 'excerpt', 'body', 'id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
