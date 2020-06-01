<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Core\Interfaces\EmpHealthAnnualPEInterface;


class ApiEmpHealthAnnualPEController extends Controller{



	protected $emp_health_ape_repo;



	public function __construct(EmpHealthAnnualPEInterface $emp_health_ape_repo){
		$this->emp_health_ape_repo = $emp_health_ape_repo;
	}



	public function edit(Request $request, $slug){

    	if($request->Ajax()){
    		$response_emp_health_ape = $this->emp_health_ape_repo->getBySlug($slug);
	    	return json_encode($response_emp_health_ape);
	    }

	    return abort(404);

    }


    
}
