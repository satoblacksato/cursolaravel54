<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
class Book extends Model
{
   
	use SoftDeletes,Sluggable,SluggableScopeHelpers;

    private $prueba;
   protected $connection='mysql';
   protected $table="books";
   protected $fillable = [
        'title','image','description','category_id','user_id,private'
    ];


        protected $events=[
            'updated' => Events\BookActionEvent::class,
        ];


 /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    

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
