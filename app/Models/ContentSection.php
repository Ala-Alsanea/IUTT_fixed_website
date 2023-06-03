<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentSection extends Model
{
      public $table = 'contents_all';
    public $primaryKey = 'id';
      //Relation to webmasterSections
    public function faculty()
    {

        return $this->belongsTo('App\Models\Faculty', 'faculty_id','id');
    }
 
    

  
 
}
