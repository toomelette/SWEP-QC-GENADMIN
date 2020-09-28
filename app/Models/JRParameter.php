<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class JRParameter extends Model{


    use Sortable;
    protected $table = 'jr_parameters';
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'jr_id' => '',
        'jr_param_id' => '',
        'stock_no' => '',
        'unit' => '',
        'item_description' => '',
        'item_name' => '',
        'qty' => 0,
        'nature_of_work' => '',

    ];


    public function jr() {
        return $this->belongsTo('App\Models\JR','jr_id','jr_id');
    }



}
