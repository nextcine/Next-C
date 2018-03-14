<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
   protected $table = 'videos';

   // relacion de uno a muchos

   public function comments(){


   		// se hace la recion con los videos , se ordenan los comentarios en orden descendente
return $this->hasMany('App\Comment')->orderby('id','desc');

   }

   // relacion, de muchos a uno 

   public function user(){


   	return $this->belongsTo('App\User','user_id');
   }
}
