<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
   
	use SoftDeletes;
    private $prueba;
   protected $connection='mysql';
   protected $table="books";
   protected $fillable = [
        'title','image','description','category_id','user_id,private'
    ];

     //relaciones
    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

     //relaciones
    public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }


//mutators para mayusculas
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }


}
