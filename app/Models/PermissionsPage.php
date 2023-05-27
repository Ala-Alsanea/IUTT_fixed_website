<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionsPage extends Model
{

	  public $table = 'permissions_page';
    public function Permissions()
    {

        return $this->belongsTo('App\Models\Permissions', 'Permission_id');
    }

    public function Pages()
    {

        return $this->belongsTo('App\Models\CategorieSection', 'Page_id');
    }
}
