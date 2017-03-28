<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Category extends Model
{
	use SoftDeletes,Sluggable,SluggableScopeHelpers;

    protected $connection='mysql';
    protected $table="categories";

 protected $fillable = [
        'name', 'description'
    ];


 //relaciones
    public function books(){
    	return $this->hasMany(Book::class,'category_id','id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    //assesor para mayusculas
    public function getNameAttribute($value)
    {
       return strtoupper($value);
    }

    //relaciones
    public function user_categories(){
        return $this->hasMany(CategoryUser::class,'category_id','id');
    }


 //relaciones
    public function user_categories_filter($user){
        $count= $this->hasMany(CategoryUser::class,'category_id','id')->where('user_id','=',$user)->count();
        if($count>0){
            return true;
        }
        return false;
    }
    
    



}
