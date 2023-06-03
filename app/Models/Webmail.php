<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webmail extends Model
{
    //
    public function webmailsGroup()
    {

        return $this->belongsTo('App\Models\WebmailsGroup', 'group_id')->orderby('id', 'asc');
    }

    //Relation to files
    public function files()
    {

        return $this->hasMany('App\Models\WebmailsFile', 'webmail_id')->orderby('id', 'asc');
    }
}
