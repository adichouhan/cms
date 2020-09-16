<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    public function complaint()
    {
        return $this->hasOne(new Complaint(), 'complaint', 'id');
    }

    public function getUserComplaints()
    {
        return $this->complaint && $this->complaint->where('user_id', auth()->user()->id) ?? collect();
    }

    public function asset()
    {
        return $this->hasOne('App/Assets', 'asset', 'id');
    }

    public function getUserAssets(){
        return $this->asset()->where('user_id', auth()->user()->id);
    }
}
