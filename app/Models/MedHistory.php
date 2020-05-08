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
        'med_history_id' => '',
        'seq_no' => 0,
        'name' => '',
        
    ];


    public function empMedHistory() {
        return $this->hasMany('App\Models\EmpMedHistory','med_history_id','med_history_id');
    }
    

}

