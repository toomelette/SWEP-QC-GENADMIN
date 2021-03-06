<?php

namespace App\Core\Interfaces;
 


interface JRInterface {

	public function fetch($request);

	public function fetchByDeptId($dept_id, $request);

	public function store($request);

	public function update($request, $slug);

	public function updateJRNo($request, $slug);

	public function destroy($slug);

	public function findBySlug($menu_id);

	public function getAll();

	public function getList($request);
		
}