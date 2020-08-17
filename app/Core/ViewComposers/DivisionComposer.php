<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\DivisionInterface;


class DivisionComposer{
   


	protected $division_repo;



	public function __construct(DivisionInterface $division_repo){
		$this->division_repo = $division_repo;
	}



    public function compose($view){
        $divisions = $this->division_repo->getAll();
    	$view->with('global_divisions_all', $divisions);
    }




}