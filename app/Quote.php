<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;

    public function complaints()
    {
       return  $this->hasOne(new Complaint(), 'id', 'complaint' );
    }

    public function getUserComplaints(){
        return  $this->complaints()->where('user_id', auth()->user()->id);
    }

    public function asset()
    {
        return $this->hasOne(new Assets(), 'id', 'asset' );
    }

    public function getUserAssets(){
        return  $this->asset()->where('user_id', auth()->user()->id);
    }
}
