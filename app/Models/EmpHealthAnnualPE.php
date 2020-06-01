<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon;


class EmpHealthAnnualPE extends Model{
	

    use Sortable;
    protected $table = 'emp_health_annual_pe';
    protected $dates = ['date', 'created_at', 'updated_at'];
    public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'emp_health_id' => '',
        'date' => null,
        'pe' => '',
        'cbc' => '',
        'chem' => '',
        'urinalysis' => '',
        'xray' => '',
        'ecg' => '',
        'ultrasound' => '',
        'drug_test' => '',
        'company_cond' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    public function getDateAttribute($value){
        return Carbon::parse($value)->format('m/d/Y');
    }
    


    /** RELATIONSHIPS **/
    public function empHealth() {
    	return $this->belongsTo('App\Models\EmpHealth','emp_health_id','emp_health_id');
   	}



}
