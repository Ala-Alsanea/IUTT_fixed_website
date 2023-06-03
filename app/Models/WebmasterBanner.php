<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebmasterBanner extends Model
{
    //
    public function banners()
    {

        return $this->hasMany('App\Models\Banner', 'section_id');
    }
}
