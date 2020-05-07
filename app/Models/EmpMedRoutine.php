<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class EmpMedRoutine extends Model{


    use Sortable;

    protected $table = 'emp_med_routine';
	public $timestamps = false;


    protected $attributes = [

        'emp_id' => '',
        'seq_no' => 0,
        'question' => '',
        'description' => '',
        'answer_mult' => null,
        'answer_desc' => '',
        
    ];
	

    public function empMaster() {
    	return $this->belongsTo('App\Models\EmpMaster','emp_id','emp_id');
   	}
    

}

