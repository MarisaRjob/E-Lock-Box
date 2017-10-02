<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreateCase extends Model
{
    //
    protected $table = 'cases';
    protected $fillable = [
        'email', 'cm_id', 'cm_name', 'first_name', 'last_name', 'birthday', 'gender', 'ssn', 'ilp', 'ethnicity', 'program', 'status',
    ];
}
