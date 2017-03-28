<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendMail extends Model
{
    use  SoftDeletes;
     protected $connection='mysql';
   protected $table="mail_users";

 protected $fillable = [
        'to','template','names','subject','files','parameters'
    ];

      public function getParametersAttribute($value)
    {
       return json_decode($value);
    }
}
