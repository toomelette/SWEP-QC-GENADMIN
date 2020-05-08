<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\EmpMedHistoryInterface;
use App\Models\EmpMedHistory;


class EmpMedHistoryRepository extends BaseRepository implements EmpMedHistoryInterface {
	

    protected $emp_med_history;


	public function __construct(EmpMedHistory $emp_med_history){

        $this->emp_med_history = $emp_med_history;
        parent::__construct();

    }




    public function store($emp, $med_history, $data){

        $emp_med_history = new EmpMedHistory;
        $emp_med_history->emp_id = $emp->emp_id;
        $emp_med_history->med_history_id = $med_history->med_history_id;
        $emp_med_history->status = $this->__dataType->string_to_boolean($data['status']);
        $emp_med_history->medication = $data['medication'];
        $emp_med_history->other_info = $data['other_info'];
        $emp_med_history->save();
        
        return $emp_med_history;

    }




}