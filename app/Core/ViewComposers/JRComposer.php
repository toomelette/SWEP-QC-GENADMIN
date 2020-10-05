<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\JRInterface;


class JRComposer{
   


	protected $jr_repo;



	public function __construct(JRInterface $jr_repo){
		$this->jr_repo = $jr_repo;
	}



    public function compose($view){
        $jr = $this->jr_repo->getAll();
    	$view->with('global_jr_all', $jr);
    }




}