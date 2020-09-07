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
    public function division() {
    	return $this->hasMany('App\Models\Division','dept_id','dept_id');
   	}


    public function pr() {
        return $this->hasMany('App\Models\PR','dept_id','dept_id');
    }


    public function user() {
        return $this->hasMany('App\Models\User','dept_id','dept_id');
    }



}
