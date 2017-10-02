<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkHistory extends Model
{
    //
    protected $table = 'work_history';
    protected $fillable = [
        'case_id', 'user_id', 'start_date', 'end_date', 'company', 'level', 'address', 'status', 'industry'
    ];
}
