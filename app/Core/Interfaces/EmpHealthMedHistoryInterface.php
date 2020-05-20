<?php

namespace App\Core\Interfaces;
 


interface EmpHealthMedHistoryInterface {

	public function store($emp_health, $is_checked, $data);
		
}