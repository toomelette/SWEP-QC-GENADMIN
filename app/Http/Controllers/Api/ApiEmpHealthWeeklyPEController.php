<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Core\Interfaces\EmpHealthWeeklyPEInterface;


class ApiEmpHealthWeeklyPEController extends Controller{



	protected $emp_health_wpe_repo;



	public function __construct(EmpHealthWeeklyPEInterface $emp_health_wpe_repo){
		$this->emp_health_wpe_repo = $emp_health_wpe_repo;
	}



	public function edit(Request $request, $slug){

    	if($request->Ajax()){
    		$response_emp_health_wpe = $this->emp_health_wpe_repo->getBySlug($slug);
	    	return json_encode($response_emp_health_wpe);
	    }

	    return abort(404);

    }


    
}
