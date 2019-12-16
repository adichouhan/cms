<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeAvailability extends Model
{
    public function employee(){
        return $this->hasMany('App/Employee', 'employee_id', 'id');
    }
}
