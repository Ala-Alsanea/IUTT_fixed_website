<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityCenter extends Model
{
      public $table = 'universitycenters';
    public $primaryKey = 'id';
         public function faculty()
    {

        return $this->belongsTo('App\Models\Faculty', 'faculty_id','id');
    }
 
    public function mycontent()
    {

        return $this->hasMany('App\Models\ContentSection', 'father_id')->where('key_content','universitycenter')->orderby('row_no', 'asc');
    }


 public function staffs()
    {

        return $this->hasMany('App\Models\Staff', 'father_id')->where('section_id',44)->orderby('row_no', 'asc');
    }

      public function employees()
    {

        return $this->hasMany('App\Models\Staff', 'father_id')->where('section_id',41)->orderby('row_no', 'asc');
    }

    

}
