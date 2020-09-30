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
        'po_no' => '',
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


    // public function prParameter() {
    //     return $this->hasMany('App\Models\PRParameter','pr_id','pr_id');
    // }


    public function department() {
        return $this->belongsTo('App\Models\Department','dept_id','dept_id');
    }


    public function division() {
        return $this->belongsTo('App\Models\Division','div_id','div_id');
    }



}
