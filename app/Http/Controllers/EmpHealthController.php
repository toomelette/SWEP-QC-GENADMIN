<?php

namespace App\Http\Controllers;


// use App\Core\Interfaces\EmpHealthInterface;
// use App\Core\Interfaces\EmpHealthMedHistoryInterface;
// use App\Http\Requests\EmpHealth\EmpHealthFormRequest;
// use App\Http\Requests\EmpHealth\EmpHealthFilterRequest;


class EmpHealthController extends Controller{


    // protected $emp_health_repo;
    // protected $emp_health_mh_repo;


    // public function __construct(EmpHealthInterface $emp_health_repo, EmpHealthMedHistoryInterface $emp_health_mh_repo){
    //     $this->emp_health_repo = $emp_health_repo;
    //     $this->emp_health_mh_repo = $emp_health_mh_repo;
    //     parent::__construct();
    // }




    
    // public function index(EmpHealthFilterRequest $request){

    //     $emp_healths = $this->emp_health_repo->fetch($request);
    //     $request->flash();
    //     return view('dashboard.emp_health.index')->with('emp_healths', $emp_healths);

    // }

    


    public function create(){
        return view('dashboard.emp_health.create');
    }


   

    // public function store(EmpHealthFormRequest $request){

    //     $emp_health = $this->emp_health_repo->store($request);

    //     if(!empty($request->row)){
    //         foreach ($request->row as $row) {
    //             $emp_health_mh = $this->emp_health_mh_repo->store($row, $emp_health);
    //         }
    //     }
        
    //     $this->event->fire('emp_health.store');
    //     return redirect()->back();

    // }
 



    // public function edit($slug){

    //     $emp_health = $this->emp_health_repo->findbySlug($slug);
    //     return view('dashboard.emp_health.edit')->with('emp_health', $emp_health);

    // }




    // public function update(EmpHealthFormRequest $request, $slug){

    //     $emp_health = $this->emp_health_repo->update($request, $slug);

    //     if(!empty($request->row)){
    //         foreach ($request->row as $row) {
    //             $emp_health_mh = $this->emp_health_mh_repo->store($row, $emp_health);
    //         }
    //     }

    //     $this->event->fire('emp_health.update', $emp_health);
    //     return redirect()->route('dashboard.emp_health.index');

    // }

    


    // public function destroy($slug){

    //     $emp_health = $this->emp_health_repo->destroy($slug);
    //     $this->event->fire('emp_health.destroy', $emp_health);
    //     return redirect()->back();

    // }



    
}
