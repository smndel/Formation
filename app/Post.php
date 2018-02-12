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

    public function scopeSortBack($query, $title)
    {
        switch ($title) {
            case 'titleAsc':
                return $query->orderby('title', 'asc')->paginate(10);
                break;
            case 'titleDesc':
                return $query->orderby('title', 'desc')->paginate(10);
                break;
            case 'typeAsc':
                return $query->orderby('post_type', 'asc')->paginate(10);
                break;
            case 'typeDesc':
                return $query->orderby('post_type', 'desc')->paginate(10);
                break;
            case 'catAsc':
                return $query->orderby('category_id', 'asc')->paginate(10);
                break;
            case 'catDesc':
                return $query->orderby('category_id', 'desc')->paginate(10);
                break;
            case 'startAsc':
                return $query->orderby('started_at', 'asc')->paginate(10);
                break;
            case 'startDesc':
                return $query->orderby('started_at', 'desc')->paginate(10);
                break;
            case 'endAsc':
                return $query->orderby('ended_at', 'asc')->paginate(10);
                break;
            case 'endDesc':
                return $query->orderby('ended_at', 'desc')->paginate(10);
                break;
            case 'priceAsc':
                return $query->orderby('price', 'asc')->paginate(10);
                break;
            case 'priceDesc':
                return $query->orderby('price', 'desc')->paginate(10);
                break;
            case 'StatusAsc':
                return $query->orderby('status', 'asc')->paginate(10);
                break;
            case 'StatusDesc':
                return $query->orderby('status', 'desc')->paginate(10);
                break;
            default:
                break;
        }
    }
}
