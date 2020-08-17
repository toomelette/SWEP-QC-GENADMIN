<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\DivisionInterface;
use App\Http\Requests\Division\DivisionFormRequest;
use App\Http\Requests\Division\DivisionFilterRequest;


class DivisionController extends Controller{


    protected $division_repo;


    public function __construct(DivisionInterface $division_repo){
        $this->division_repo = $division_repo;
        parent::__construct();
    }



    
    public function index(DivisionFilterRequest $request){

        $divisions = $this->division_repo->fetch($request);
        $request->flash();
        return view('dashboard.division.index')->with('divisions', $divisions);

    }

    


    public function create(){
        return view('dashboard.division.create');
    }


   

    public function store(DivisionFormRequest $request){

        $division = $this->division_repo->store($request);
        $this->event->fire('division.store');
        return redirect()->back();

    }
 



    public function edit($slug){

        $division = $this->division_repo->findbySlug($slug);
        return view('dashboard.division.edit')->with('division', $division);

    }




    public function update(DivisionFormRequest $request, $slug){

        $division = $this->division_repo->update($request, $slug);
        $this->event->fire('division.update', $division);
        return redirect()->route('dashboard.division.index');

    }

    


    public function destroy($slug){

        $division = $this->division_repo->destroy($slug);
        $this->event->fire('division.destroy', $division);
        return redirect()->back();

    }



    
}
