<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class JR extends Model{


    use Sortable;
    protected $table = 'jr';
    protected $dates = ['date', 'created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'jr_id' => '',
        'dept_id' => '',
        'div_id' => '',
        'jr_no' => null,
        'date' => null,
        'purpose' => null,
        'req_by_name' => null,
        'req_by_designation' => null,
        'appr_by_name' => null,
        'appr_by_designation' => null,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];


    public function jrParameter() {
        return $this->hasMany('App\Models\JRParameter','jr_id','jr_id');
    }


    public function department() {
        return $this->belongsTo('App\Models\Department','dept_id','dept_id');
    }


    public function division() {
        return $this->belongsTo('App\Models\Division','div_id','div_id');
    }



    public function displayJRNoSpan(){

        $span = '';

        if (isset($this->jr_no)) {
            $span = '<span class="badge bg-green">'. $this->jr_no .'</span>';
        }else{
            $span = '<span class="badge bg-red">Not Set</span>';
        }

        return $span;

    }



}
