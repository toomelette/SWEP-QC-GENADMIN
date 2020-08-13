<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Department extends Model{


    use Sortable;
    protected $table = 'departments';
    protected $dates = ['created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'dept_id' => '',
        'name' => '',
        'acronym' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    /** RELATIONSHIPS **/
    // public function user() {
    // 	return $this->belongsTo('App\Models\User','user_id','user_id');
   	// }



}
