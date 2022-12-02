<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    //Relationship 1 to many
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    //Relationship 1 to many
    public function likes(){
        return $this->hasMany('App\Like');
    }

    //Relationship many to 1
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
