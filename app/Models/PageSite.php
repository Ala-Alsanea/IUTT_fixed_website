<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSite extends Model
{
      public $table = 'page_site';
    public $primaryKey = 'id';
    public function faculty()
    {

        return $this->belongsTo('App\Models\Faculty', 'faculty_id','id');
    }
 
    public function mycontent()
    {

        return $this->belongsTo('App\Models\ContentSection', 'father_id','id')->orderby('row_no', 'asc');
    }

   public function father()
    {

        return $this->belongsTo('App\Models\Topic', 'father_id','id')->orderby('row_no', 'asc');
    }
   
 

    //Relation to Maps
    public function maps()
    {

        return $this->hasMany('App\Models\Map', 'topic_id')->orderby('row_no', 'asc');
    }

 
}
