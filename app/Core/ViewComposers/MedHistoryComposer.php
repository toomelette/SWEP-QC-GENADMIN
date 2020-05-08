<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\MedHistoryInterface;


class MedHistoryComposer{
   



	protected $med_history_repo;




	public function __construct(MedHistoryInterface $med_history_repo){

		$this->med_history_repo = $med_history_repo;

	}





    public function compose($view){

        $med_history = $this->med_history_repo->getAll();
        
    	$view->with('global_med_history_all', $med_history);

    }






}