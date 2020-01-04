<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function subCat()
    {
        $this->hasMany('App/SubCategory', 'parent_id', 'id');
    }
}
