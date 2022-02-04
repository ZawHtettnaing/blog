<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  function category(){
    return $this->belongsTo('App\Category');
  }

  function comments(){
    return $this->hasMany('App\Comment');
  }

  function user(){
    return $this->belongsTo('App\User');
  }

    //
}
