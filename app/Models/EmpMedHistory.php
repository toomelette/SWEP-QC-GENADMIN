<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class EmpMedHistory extends Model{


    use Sortable;

    protected $table = 'emp_med_history';
	public $timestamps = false;


    protected $attributes = [

        'emp_id' => '',
        'seq_no' => 0,
        'name' => '',
        'status' => 0,
        'medication' => '',
        'other_info' => '',

    ];
	

    public function empMaster() {
    	return $this->belongsTo('App\Models\EmpMaster','emp_id','emp_id');
   	}
    

}
