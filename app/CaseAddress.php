<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseAddress extends Model
{
    //
    protected $table = 'case_address';
    protected $fillable = [
        'case_id', 'address', 'city', 'state', 'zipcode', 'status',
    ];
}
