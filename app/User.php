<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


     protected $events=[
            'created' => Events\UserCreatedEvent::class,
        ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

 //relaciones
    public function role(){
        return $this->belongsTo(Role::class,'role_id','id');
    }

     //relaciones
    public function books(){
        return $this->hasMany(Book::class,'user_id','id');
    }


      //relaciones
    public function user_categories(){
        return $this->hasMany(CategoryUser::class,'user_id','id');
    }


    public function isAdmin(){
            return  $this->role->id == env('ROLE_ADMIN');
    }

}
