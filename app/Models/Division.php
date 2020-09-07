<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Division extends Model{


    use Sortable;
    protected $table = 'divisions';
    protected $dates = ['created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'div_id' => '',
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
    public function department() {
    	return $this->belongsTo('App\Models\Department','dept_id','dept_id');
   	}


    public function user() {
        return $this->hasMany('App\Models\User','div_id','div_id');
    }


    public function pr() {
        return $this->hasMany('App\Models\PR','div_id','div_id');
    }



}
