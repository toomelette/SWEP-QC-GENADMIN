<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class PR extends Model{


    use Sortable;
    protected $table = 'pr';
    protected $dates = ['pr_no_date', 'sai_no_date', 'created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'pr_id' => '',
        'dept_id' => '',
        'div_id' => '',
        'pr_no' => null,
        'pr_no_date' => null,
        'sai_no' => null,
        'sai_no_date' => null,
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


    public function prParameter() {
        return $this->hasMany('App\Models\PRParameter','pr_id','pr_id');
    }


    public function department() {
        return $this->belongsTo('App\Models\Department','dept_id','dept_id');
    }


    public function division() {
        return $this->belongsTo('App\Models\Division','div_id','div_id');
    }



    public function displayPRNoSpan(){

        $span = '';

        if (isset($this->pr_no)) {
            $span = '<span class="badge bg-green">'. $this->pr_no .'</span>';
        }else{
            $span = '<span class="badge bg-red">Not Set</span>';
        }

        return $span;

    }



}
