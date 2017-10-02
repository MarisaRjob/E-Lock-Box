<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasePhone extends Model
{
    //
    protected $table = 'case_phone';
    protected $fillable = [
        'case_id', 'number', 'type', 'status',
    ];
}
