<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactsGroup extends Model
{
    //
    public function contacts()
    {

        return $this->hasMany('App\Models\Contact', 'group_id');
    }
}
