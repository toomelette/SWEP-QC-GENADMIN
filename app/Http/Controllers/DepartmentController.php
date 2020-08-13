<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\DepartmentInterface;
use App\Http\Requests\Department\DepartmentFormRequest;
use App\Http\Requests\Department\DepartmentFilterRequest;


class DepartmentController extends Controller{


    protected $department_repo;


    public function __construct(DepartmentInterface $department_repo){
        $this->department_repo = $department_repo;
        parent::__construct();
    }



    
    public function index(DepartmentFilterRequest $request){

        $departments = $this->department_repo->fetch($request);
        $request->flash();
        return view('dashboard.department.index')->with('departments', $departments);

    }

    


    public function create(){
        return view('dashboard.department.create');
    }


   

    public function store(DepartmentFormRequest $request){

        $department = $this->department_repo->store($request);
        $this->event->fire('department.store');
        return redirect()->back();

    }
 



    public function edit($slug){

        $department = $this->department_repo->findbySlug($slug);
        return view('dashboard.department.edit')->with('department', $department);

    }




    public function update(DepartmentFormRequest $request, $slug){

        $department = $this->department_repo->update($request, $slug);
        $this->event->fire('department.update', $department);
        return redirect()->route('dashboard.department.index');

    }

    


    public function destroy($slug){

        $department = $this->department_repo->destroy($slug);
        $this->event->fire('department.destroy', $department);
        return redirect()->back();

    }



    
}
