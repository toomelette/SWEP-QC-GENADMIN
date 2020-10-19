<?php

namespace App\Core\Interfaces;
 


interface JOInterface {

	public function fetch($request);

	public function fetchByDeptId($dept_id, $request);

	public function store($request);

	public function update($request, $slug);

	public function updateJONo($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);
		
}