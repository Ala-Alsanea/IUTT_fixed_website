<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieSection extends Model
{

	 
     public function CatsubMenus()
    {

        return $this->hasMany('App\Models\CategorieSection', 'Father_id')->orderby('row_no', 'asc');
    }

    public function CatWebmasterSection()
    {

        return $this->belongsTo('App\Models\WebmasterSection', 'Subcat_id');
    }

     public $table = 'categorie_section';
    public $primaryKey = 'Cat_id';
 


 }
