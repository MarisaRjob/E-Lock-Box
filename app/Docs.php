<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docs extends Model
{
    //
    protected $table = 'docs';
    protected $fillable = [
        'case_id', 'title', 'type', 'path', 'description', 'filename', 'uploader'
    ];
}
