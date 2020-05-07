<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MedHistory extends Model{


    use Sortable;


    protected $table = 'med_history';
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'med_history_id' => 0,
        'seq_no' => 0,
        'name' => '',
        
    ];
    

}

