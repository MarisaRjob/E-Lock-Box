<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    //
    protected $table = 'avatar';
    protected $fillable = [
        'case_id', 'path', 'filename'
    ];
}
