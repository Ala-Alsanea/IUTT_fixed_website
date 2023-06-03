<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderFaculty extends Model
{
      public $table = 'slider_faculties';
    public $primaryKey = 'id';

  public function faculty()
    {

        return $this->belongsTo('App\Models\Faculty', 'faculty_id','id');
    }
 
 

}
