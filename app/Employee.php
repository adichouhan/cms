<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
   public function availability(){
      return $this->hasMany('App/EmployeeAvailability', 'employee_id', 'id');
   }
}
