<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
      public $table = 'academic_staff';
    public $primaryKey = 'id';


      public function faculty()
    {

        return $this->belongsTo('App\Models\Faculty', 'faculty_id','id');
    }
 
 

}
