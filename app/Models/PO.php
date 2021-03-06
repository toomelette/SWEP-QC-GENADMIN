<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class PO extends Model{


    use Sortable;
    protected $table = 'po';
    protected $dates = ['date', 'date_of_delivery', 'created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'po_id' => '',
        'dept_id' => '',
        'div_id' => '',
        'to' => '',
        'address' => '',
        'tin' => '',
        'po_no' => null,
        'date' => null,
        'mode_of_procurement' => '',
        'place_of_delivery' => '',
        'date_of_delivery' => null,
        'delivery_term' => '',
        'payment_term' => '',
        'name_of_supplier' => '',
        'bur_no' => '',
        'amount' => 0.000,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];


    public function poParameter() {
        return $this->hasMany('App\Models\POParameter','po_id','po_id');
    }


    public function department() {
        return $this->belongsTo('App\Models\Department','dept_id','dept_id');
    }


    public function division() {
        return $this->belongsTo('App\Models\Division','div_id','div_id');
    }



    public function displayPONoSpan(){

        $span = '';

        if (isset($this->po_no)) {
            $span = '<span class="badge bg-green">'. $this->po_no .'</span>';
        }else{
            $span = '<span class="badge bg-red">Not Set</span>';
        }

        return $span;

    }



}
