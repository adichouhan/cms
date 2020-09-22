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
        return $this->hasOne('App/User', 'user_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(new Invoice(), 'complaint', 'id');
    }

    public function quotes()
    {
        return $this->hasMany(new Quote(), 'complaint', 'id');
    }

    public function getUserInvoices(){
        return $this->where('user_id', auth()->user()->id)->invoices;
    }

    public function getUserQuotes(){
        return $this->where('user_id', auth()->user()->id)->quotes;
    }

}
