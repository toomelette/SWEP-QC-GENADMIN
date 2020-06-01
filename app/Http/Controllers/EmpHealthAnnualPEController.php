<?php

namespace App\Http\Controllers;

use App\Core\Interfaces\EmpHealthAnnualPEInterface;
use App\Http\Requests\EmpHealthAnnualPE\EmpHealthAnnualPEFormRequest;
use App\Http\Requests\EmpHealthAnnualPE\EmpHealthAnnualPEAjaxFormRequest;


class EmpHealthAnnualPEController extends Controller{


    protected $emp_health_annual_pe_repo;


    public function __construct(EmpHealthAnnualPEInterface $emp_health_annual_pe_repo){
        $this->emp_health_annual_pe_repo = $emp_health_annual_pe_repo;
        parent::__construct();
    }


   

    public function store(EmpHealthAnnualPEFormRequest $request){

        $emp_health_annual_pe = $this->emp_health_annual_pe_repo->store($request);
        
        $this->event->fire('emp_health_annual_pe.store', $emp_health_annual_pe);
        return redirect()->back();

    }




    public function update(EmpHealthAnnualPEAjaxFormRequest $request, $slug){

        $emp_health_annual_pe = $this->emp_health_annual_pe_repo->update($request, $slug);

        $this->event->fire('emp_health_annual_pe.update', $emp_health_annual_pe);
        return redirect()->back();

    }

    


    public function destroy($slug){

        $emp_health_annual_pe = $this->emp_health_annual_pe_repo->destroy($slug);
        $this->event->fire('emp_health_annual_pe.destroy', $emp_health_annual_pe);
        return redirect()->back();

    }



    
}
