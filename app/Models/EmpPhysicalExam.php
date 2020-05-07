<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class EmpPhysicalExam extends Model{

    use Sortable;

    protected $table = 'emp_physical_exam';
    protected $dates = ['date'];
	public $timestamps = false;


    protected $attributes = [

        'emp_id' => '',
        'date' => null,
        'blood_pressure' => '',
        'pulse_rate' => '',
        'temperature' => '',
        'symptoms_condition' => '',
        'medication_given' => '',
        'recommendation' => '',
        
    ];
	

    public function empMaster() {
    	return $this->belongsTo('App\Models\EmpMaster','emp_id','emp_id');
   	}


}
