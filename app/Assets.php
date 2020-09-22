<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assets extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        $this->hasOne('App/User', 'user_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(new Invoice(), 'asset', 'id');
    }

    public function quotes()
    {
        return $this->hasMany(new Quote(), 'asset', 'id');
    }

    public function getUserInvoices(){
        return $this->where('user_id', auth()->user()->id)->invoices;
    }

    public function getUserQuotes(){
        return $this->where('user_id', auth()->user()->id)->quotes;
    }
}
