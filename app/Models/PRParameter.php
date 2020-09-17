<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class PRParameter extends Model{


    use Sortable;
    protected $table = 'pr_parameters';
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'pr_id' => '',
        'pr_param_id' => '',
        'stock_no' => '',
        'unit' => '',
        'item_description' => '',
        'item_name' => '',
        'qty' => 0,
        'unit_cost' => 0.00,
        'total_cost' => 0.00,

    ];


    public function pr() {
        return $this->belongsTo('App\Models\PR','pr_id','pr_id');
    }



}
