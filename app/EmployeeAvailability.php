<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeAvailability extends Model
{
    use SoftDeletes;


    public function employee(){
        return $this->belongsTo(new Employee(), 'employee_id', 'id');
    }
}
