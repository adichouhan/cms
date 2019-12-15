<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function subCat()
    {
        $this->hasMany('App/SubCategory', 'parent_id', 'id');
    }
}
