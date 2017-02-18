<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;
    protected $connection='mysql';
    protected $table="categories";

 protected $fillable = [
        'name', 'description'
    ];


 //relaciones
    public function books(){
    	return $this->hasMany(Book::class,'category_id','id');
    }


}
