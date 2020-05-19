<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\EmpHealthMedHistoryInterface;
use App\Models\EmpHealthMedHistory;


class EmpHealthMedHistoryRepository extends BaseRepository implements EmpHealthMedHistoryInterface {
	

    protected $emp_health_mh;


	public function __construct(EmpHealthMedHistory $emp_health_mh){

        $this->emp_health_mh = $emp_health_mh;
        parent::__construct();

    }



    // public function store($data, $menu){

    //     $emp_health_mh = new EmpHealthMedHistory;
    //     $emp_health_mh->slug = $this->str->random(16);
    //     $emp_health_mh->emp_health_mh_id = $data['sub_emp_health_mh_id'];
    //     $emp_health_mh->menu_id = $menu->menu_id;
    //     $emp_health_mh->name = $data['sub_name'];
    //     $emp_health_mh->nav_name = $data['sub_nav_name'];
    //     $emp_health_mh->route = $data['sub_route'];
    //     $emp_health_mh->is_nav = $this->__dataType->string_to_boolean($data['sub_is_nav']);  
    //     $emp_health_mh->save();
        
    //     return $emp_health_mh;

    // }




}