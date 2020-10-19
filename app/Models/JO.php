<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class JO extends Model{


    use Sortable;
    protected $table = 'jo';
    protected $dates = ['date', 'date_of_delivery', 'created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'jo_id' => '',
        'jr_id' => '',
        'dept_id' => '',
        'div_id' => '',
        'to' => '',
        'address' => '',
        'tin' => '',
        'jo_no' => '',
        'date' => null,
        'place_of_delivery' => '',
        'date_of_delivery' => null,
        'delivery_term' => '',
        'payment_term' => '',
        'description' => '',
        'scope_of_works' => '',
        'bur_no' => '',
        'amount' => 0.000,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];


    public function department() {
        return $this->belongsTo('App\Models\Department','dept_id','dept_id');
    }


    public function division() {
        return $this->belongsTo('App\Models\Division','div_id','div_id');
    }


    public function jr() {
        return $this->belongsTo('App\Models\JR','jr_id','jr_id');
    }



    public function displayJONoSpan(){

        $span = '';

        if (isset($this->jo_no)) {
            $span = '<span class="badge bg-green">'. $this->jo_no .'</span>';
        }else{
            $span = '<span class="badge bg-red">Not Set</span>';
        }

        return $span;

    }




}
