<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramList extends Model
{
    //
    protected $table = 'program_list';
    protected $fillable = [
        'program_abbr', 'program_name',
    ];
}
