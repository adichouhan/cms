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

    public function availableStatus(){
        return $this->available_status == 1 ? "Available" : "UnAvailable";
    }

    public function workStatus(){
        return $this->onWork == 1 ? "Yes" : "No";
    }
}
