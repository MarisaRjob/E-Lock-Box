<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $table = 'activities';
    protected $fillable = [
        'subject', 'message', 'task', 'ddl', 'assigned', 'creator', 'mentioned', 'related', 'reci_status', 'ment_status'
    ];
}
