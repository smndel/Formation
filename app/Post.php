<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function category(){
    	return $this->belongsTo(Genre::class);
    }

    public function teachers(){
    	return $this->belongsToMany(Author::class);
    }

    public function picture(){
    	return $this->hasOne(Picture::class);
    }

}
