<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MedRoutine extends Model{


    use Sortable;


    protected $table = 'med_routines';
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'med_routine_id' => 0,
        'seq_no' => 0,
        'question' => '',
        'description' => '',
        
    ];
    

}

