<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsPage extends Model
{
    //
    public function visitor()
    {

        return $this->belongsTo('App\Models\AnalyticsVisitor', 'visitor_id')->orderby('id', 'desc');
    }
}
