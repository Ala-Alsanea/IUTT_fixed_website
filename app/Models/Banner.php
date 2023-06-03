<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    public function webmasterBanner()
    {

        return $this->belongsTo('App\Models\WebmasterBanner', 'section_id');
    }
}
