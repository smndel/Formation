<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{

    protected $fillable = [
        'title', 'description','started_at','ended_at', 'post_type', 'status', 'price', 'student_max','category_id', 
    ];

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function teachers(){
    	return $this->belongsToMany(Teacher::class);
    }

    public function picture(){
    	return $this->hasOne(Picture::class);
    }

    //Créer une fonction pour déterminer la durée du cours
    // public function dateInterval($date1, $date2){
    // 	return $interval = $date1->diff($date2);
    // }

    public function setCategoryIdAttribute($value){
        if($value == 0){
            $this->attributes['category_id']= null;
        }else{
            $this->attributes['category_id'] = $value;
        }
    }

    public function getStartedAtAttribute($value){
        return Carbon::parse($value)->format('d-m-Y H:i');
    }

    public function getEndedAtAttribute($value){
        return Carbon::parse($value)->format('d-m-Y H:i');
    }

    public function scopePublished($query){
        return $query->where('status', 'published');
    }

    public function scopeSearch($query, $q)
    {
        return $query->where( 'title', 'LIKE', '%' . $q . '%' )
                    ->orWhere('post_type', 'LIKE', '%' . $q . '%' )
                    ->orWhere('description', 'LIKE', '%' . $q . '%' );
    }


    // public function setStartedAtAttribute($value)
    // {
    //     if ( $value !== null & $value === '' )
    //     {
    //     $this->attributes['started_at'] = ($value);
    //     }
    // }

    // public function setEndedAtAttribute($value)
    // {
    //     if ( $value !== null & $value === '' )
    //     {
    //     $this->attributes['ended_at'] = ($value);
    //     }
    // }


}
