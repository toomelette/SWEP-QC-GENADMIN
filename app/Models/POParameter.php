<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class POParameter extends Model{


    use Sortable;
    protected $table = 'po_parameters';
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'po_id' => '',
        'po_param_id' => '',
        'stock_no' => '',
        'unit' => '',
        'item_description' => '',
        'item_name' => '',
        'qty' => 0,
        'unit_cost' => 0.00,
        'total_cost' => 0.00,

    ];


    public function po() {
        return $this->belongsTo('App\Models\PO','po_id','po_id');
    }



}
