<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeAvailability extends Model
{
    public function employee(){
        return $this->belongsTo(new Employee(), 'employee_id', 'id');
    }
}
