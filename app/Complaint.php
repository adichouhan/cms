<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        $this->hasOne('App/User', 'user_id', 'id');
    }
}
