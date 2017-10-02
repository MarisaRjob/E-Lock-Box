<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddContact extends Model
{
    //
    protected $table = 'additional_contacts';
    protected $fillable = [
        'case_id', 'name', 'relationship', 'phone', 'email', 'address', 'status'
    ];
}