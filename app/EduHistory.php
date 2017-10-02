<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EduHistory extends Model
{
    //
    protected $table = 'edu_history';
    protected $fillable = [
        'case_id', 'start_date', 'end_date', 'school', 'level', 'address', 'status'
    ];
}
