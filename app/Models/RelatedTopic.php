<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedTopic extends Model
{
    //Relation to Related Topics one topic
    public function topic()
    {
        return $this->belongsTo('App\Models\Topic', 'topic2_id');
    }
}
