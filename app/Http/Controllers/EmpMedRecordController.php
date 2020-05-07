<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\EmpMasterInterface;
use App\Http\Requests\EmpMedRecord\EmpMedRecordFormRequest;
use App\Http\Requests\EmpMedRecord\EmpMedRecordFilterRequest;


class EmpMedRecordController extends Controller{


    protected $emp_master_repo;


    public function __construct(EmpMasterInterface $emp_master_repo){
        $this->emp_master_repo = $emp_master_repo;
        parent::__construct();
    }



    
    public function index(EmpMedRecordFilterRequest $request){

        $employees = $this->emp_master_repo->fetch($request);
        $request->flash();
        return view('dashboard.emp_med_record.index')->with('employees', $employees);

    }
 



    public function edit($slug){

        $emp = $this->emp_master_repo->findbySlug($slug);
        return view('dashboard.emp_med_record.edit')->with('emp', $emp);

    }




    // public function update(EmpMedRecordFormRequest $request, $slug){

    //     $emp = $this->emp_master_repo->update($request, $slug);

    //     if(!empty($request->row)){
    //         foreach ($request->row as $row) {
    //             $subemp = $this->subemp_master_repo->store($row, $emp);
    //         }
    //     }

    //     $this->event->fire('emp.update', $emp);
    //     return redirect()->route('dashboard.emp.index');

    // }



    
}
