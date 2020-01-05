<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;

    public function complaint()
    {
        $this->hasOne('App/Complaint', 'complaint', 'id');
    }

    public function getUserComplaints(){
        return $this->complaint()->where('user_id', auth()->user()->id);
    }

    public function asset()
    {
        $this->hasOne('App/Assets', 'asset', 'id');
    }

    public function getUserAssets(){
        return $this->asset()->where('user_id', auth()->user()->id);
    }
}
