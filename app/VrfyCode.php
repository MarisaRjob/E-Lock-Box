<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VrfyCode extends Model
{
    //
    protected $table = 'code';
    protected static $userModel = 'Cartalyst\Sentinel\Users\EloquentUser';
    public function users() {
        return $this->belongsTo(static::$userModel, 'user_id');
    }
    protected $fillable = [
        'user_id', 'code',
    ];
}
