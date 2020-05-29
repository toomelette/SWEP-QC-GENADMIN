<?php

namespace App\Core\Interfaces;
 


interface EmpHealthWeeklyPEInterface {

	public function fetchByEmpHealthId($emp_health_id, $request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function getBySlug($slug);
		
}