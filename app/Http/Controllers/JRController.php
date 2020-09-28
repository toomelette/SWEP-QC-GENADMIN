<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\JRInterface;
use App\Core\Interfaces\JRParameterInterface;
use App\Http\Requests\JR\JRFormRequest;
use App\Http\Requests\JR\JRFilterRequest;


class JRController extends Controller{


    protected $jr_repo;
    protected $jr_parameter_repo;


    public function __construct(JRInterface $jr_repo, JRParameterInterface $jr_parameter_repo){
        $this->jr_repo = $jr_repo;
        $this->jr_parameter_repo = $jr_parameter_repo;
        parent::__construct();
    }



    
    public function index(JRFilterRequest $request){

        $jr_list = $this->jr_repo->fetch($request);
        $request->flash();
        return view('dashboard.jr.index')->with('jr_list', $jr_list);

    }

    


    public function create(){
        return view('dashboard.jr.create');
    }


   

    public function store(JRFormRequest $request){

        $jr = $this->jr_repo->store($request);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $jr_parameter = $this->jr_parameter_repo->store($row, $jr);
            }
        }

        $this->event->fire('jr.store', $jr);
        return redirect()->back();

    }
 



    public function edit($slug){

        $pr = $this->jr_repo->findbySlug($slug);
        return view('dashboard.jr.edit')->with('jr', $pr);

    }
 



    public function show($slug){

        $jr = $this->jr_repo->findbySlug($slug);
        return view('dashboard.jr.show')->with('jr', $jr);

    }
 



    public function print($slug, $page){

        $jr = $this->jr_repo->findbySlug($slug);

        if ($page == 'FRONT') {
            return view('printables.jr.jr_form_front')->with('jr', $jr);
        }else{
            abort(404);
        }

    }




    public function update(JRFormRequest $request, $slug){

        $jr = $this->jr_repo->update($request, $slug);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $jr_parameter = $this->jr_parameter_repo->store($row, $jr);
            }
        }
        
        $this->event->fire('jr.update', $jr);
        return redirect()->route('dashboard.jr.index');

    }

    


    public function destroy($slug){

        $jr = $this->jr_repo->destroy($slug);
        $this->event->fire('jr.destroy', $jr);
        return redirect()->back();

    }



    
}
