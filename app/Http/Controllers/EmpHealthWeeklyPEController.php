<?php

namespace App\Http\Controllers;

use App\Core\Interfaces\EmpHealthWeeklyPEInterface;
use App\Http\Requests\EmpHealthWeeklyPE\EmpHealthWeeklyPEFormRequest;
use App\Http\Requests\EmpHealthWeeklyPE\EmpHealthWeeklyPEAjaxFormRequest;


class EmpHealthWeeklyPEController extends Controller{


    protected $emp_health_weekly_pe_repo;


    public function __construct(EmpHealthWeeklyPEInterface $emp_health_weekly_pe_repo){
        $this->emp_health_weekly_pe_repo = $emp_health_weekly_pe_repo;
        parent::__construct();
    }


   

    public function store(EmpHealthWeeklyPEFormRequest $request){

        $emp_health_weekly_pe = $this->emp_health_weekly_pe_repo->store($request);
        
        $this->event->fire('emp_health_weekly_pe.store', $emp_health_weekly_pe);
        return redirect()->back();

    }




    public function update(EmpHealthWeeklyPEAjaxFormRequest $request, $slug){

        $emp_health_weekly_pe = $this->emp_health_weekly_pe_repo->update($request, $slug);

        $this->event->fire('emp_health_weekly_pe.update', $emp_health_weekly_pe);
        return redirect()->back();

    }

    


    public function destroy($slug){

        $emp_health_weekly_pe = $this->emp_health_weekly_pe_repo->destroy($slug);
        $this->event->fire('emp_health_weekly_pe.destroy', $emp_health_weekly_pe);
        return redirect()->back();

    }



    
}
