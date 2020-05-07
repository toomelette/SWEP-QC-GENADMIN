<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class EmpAnnualPhysicalExam extends Model{

    use Sortable;

    protected $table = 'emp_annual_physical_exam';
    protected $dates = ['date'];
	public $timestamps = false;


    protected $attributes = [

        'emp_id' => '',
        'date' => null,
        'pe' => '',
        'cbc' => '',
        'chem' => '',
        'urinalysis' => '',
        'xray' => '',
        'ecg' => '',
        'ultrasound' => '',
        'drug_test' => '',
        'company_conducted' => '',
        
    ];
	

    public function empMaster() {
    	return $this->belongsTo('App\Models\EmpMaster','emp_id','emp_id');
   	}


}
