<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
      public $table = 'programs';
    public $primaryKey = 'id';

         public function faculty()
    {

        return $this->belongsTo('App\Models\Faculty', 'faculty_id','id');
    }
 
    public function mycontent()
    {

        return $this->hasMany('App\Models\ContentSection', 'father_id')->where('key_content','program')->orderby('row_no', 'asc');
    }

}
