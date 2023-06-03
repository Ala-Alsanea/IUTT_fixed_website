<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //Relation to Topics
    public function topics()
    {
        return $this->belongsTo('App\Models\Topic', 'topic_id');
    }
}
