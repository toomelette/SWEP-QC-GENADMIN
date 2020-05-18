<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class EmpHealthMedHistory extends Model{
	

    protected $table = 'emp_health_med_history';
    public $timestamps = false;


    protected $attributes = [

        'emp_health_id' => '',
        'mc_id' => '',
        'medication' => '',
        'is_checked' => false,

    ];



    /** RELATIONSHIPS **/
    public function empHealth() {
    	return $this->belongsTo('App\Models\EmpHealth','emp_health_id','emp_health_id');
   	}



}
