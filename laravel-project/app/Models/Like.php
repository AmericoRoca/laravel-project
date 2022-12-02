<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;


    protected $table = 'likes';

        //Relationship many to 1
        public function user(){
            return $this->belongsTo('App\Models\User','user_id');
        }
    
        //Relationship many to 1
        public function image(){
            return $this->belongsTo('App\Models\Image','image_id');
        }
}
