<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicField extends Model
{
    public function detail_field()
    {

        return $this->belongsTo('App\Models\WebmasterSectionField', 'field_id','id');
    }
}
