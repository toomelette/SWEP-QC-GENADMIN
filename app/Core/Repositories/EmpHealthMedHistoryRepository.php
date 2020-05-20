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


    public function store($emp_health, $is_checked, $data){

        $emp_health_mh = new EmpHealthMedHistory;
        $emp_health_mh->emp_health_id = $emp_health->emp_health_id; 
        $emp_health_mh->mc_id = $data['mc_id']; 
        $emp_health_mh->is_checked = $is_checked; 
        $emp_health_mh->medication = $data['medication']; 
        $emp_health_mh->save();
        
        return $emp_health_mh;

    }


}