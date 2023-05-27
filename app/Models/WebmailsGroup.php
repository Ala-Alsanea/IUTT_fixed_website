<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebmailsGroup extends Model
{
    //
    public function webmails()
    {

        return $this->hasMany('App\Models\Webmail', 'group_id');
    }
}
