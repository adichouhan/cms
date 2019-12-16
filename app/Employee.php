<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   public function availability(){
      return $this->hasMany('App/EmployeeAvailability', 'employee_id', 'id');
   }
}