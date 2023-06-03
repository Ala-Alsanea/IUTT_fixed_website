<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
      public $table = 'faculties';
    public $primaryKey = 'id';

      //Relation to webmasterSections
    public function departments()
    {

        return $this->hasMany('App\Models\Department', 'faculty_id')->orderby('row_no', 'asc');
    }

    public function programs()
    {

        return $this->hasMany('App\Models\Program', 'faculty_id')->orderby('row_no', 'asc');
    }
 public function mycontent()
    {

        return $this->hasMany('App\Models\ContentSection', 'faculty_id')->where('key_content','faculty')->orderby('row_no', 'asc');
    }
 public function sliderfaculties()
    {

        return $this->hasMany('App\Models\SliderFaculty', 'faculty_id');
    }
    public function pagessite()
    {

        return $this->hasMany('App\Models\PageSite', 'faculty_id');
    }
//
public function staffs()
    {

        return $this->hasMany('App\Models\Staff', 'faculty_id')->where('section_id',40)->orderby('row_no', 'asc');
    }

      public function employees()
    {

        return $this->hasMany('App\Models\Staff', 'faculty_id')->where('section_id',41)->orderby('row_no', 'asc');
    }

    public function students()
    {

        return $this->hasMany('App\Models\Student', 'faculty_id');
    }

  public function announcements()
    {

        return $this->hasMany('App\Models\Topic', 'faculty_id')->where('webmaster_id',11)->orderby('row_no', 'desc');
    } 
   
    public function events()
    {

        return $this->hasMany('App\Models\Topic', 'faculty_id')->where('webmaster_id',12)->orderby('row_no', 'desc');
    } 

  public function photos_gellary()
    {

        return $this->hasMany('App\Models\Topic', 'faculty_id')->where('webmaster_id',4)->orderby('row_no', 'desc');
    } 
  public function lecturerstable()
    {

        return $this->hasMany('App\Models\Topic', 'faculty_id')->where('webmaster_id',28)->orderby('row_no', 'desc');
    } 
 public function news()
    {

        return $this->hasMany('App\Models\Topic', 'faculty_id')->where('webmaster_id',3)->orderby('row_no', 'desc');
    } 
    
    //Relation to Maps
    public function maps()
    {

        return $this->hasMany('App\Models\Map', 'topic_id')->orderby('row_no', 'asc');
    }
 
}
