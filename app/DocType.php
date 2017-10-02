<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocType extends Model
{
    //
    protected $table = 'document_list';
    protected $fillable = [
        'document_abbr', 'document_type',
    ];
}
