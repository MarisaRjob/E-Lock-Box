<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseEmail extends Model
{
    //
    protected $table = 'case_email';
    protected $fillable = [
        'case_id', 'email', 'status',
    ];
}
