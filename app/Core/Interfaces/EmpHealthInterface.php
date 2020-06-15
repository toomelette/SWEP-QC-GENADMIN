<?php

namespace App\Core\Interfaces;
 


interface EmpHealthInterface {

	public function fetch($request);

	public function store($request, $file_location);

	public function update($request, $file_location, $emp_health);

	public function destroy($slug);

	public function findBySlug($menu_id);
		
}