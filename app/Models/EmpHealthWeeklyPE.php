<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon;


class EmpHealthWeeklyPE extends Model{
	

    use Sortable;
    protected $table = 'emp_health_weekly_pe';
    protected $dates = ['date', 'created_at', 'updated_at'];
    public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'emp_health_id' => '',
        'date' => null,
        'blood_pressure' => '',
        'pulse_rate' => '',
        'temperature' => '',
        'condition' => '',
        'medication' => '',
        'recommendation' => '',

    ];



    public function getDateAttribute($value){
        return Carbon::parse($value)->format('m/d/Y');
    }
    


    /** RELATIONSHIPS **/
    public function empHealth() {
    	return $this->belongsTo('App\Models\EmpHealth','emp_health_id','emp_health_id');
   	}


}
