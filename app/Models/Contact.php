<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    public function contactsGroup()
    {

        return $this->belongsTo('App\Models\ContactsGroup', 'group_id');
    }
}
