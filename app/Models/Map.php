<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    //Relation to Topics
    public function topics()
    {
        return $this->belongsTo('App\Models\Topic', 'topic_id');
    }
}
