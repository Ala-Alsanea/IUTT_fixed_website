<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    public function subMenus()
    {

        return $this->hasMany('App\Models\Menu', 'father_id')->orderby('row_no', 'asc');
    }
 public function parentMenus()
    {

        return $this->belongsTo('App\Models\Menu', 'father_id','id')->orderby('row_no', 'asc');
    }
    public function webmasterSection()
    {

        return $this->belongsTo('App\Models\WebmasterSection', 'cat_id');
    }
}
