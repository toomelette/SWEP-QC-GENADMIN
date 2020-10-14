<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\JRInterface;
use App\Core\Interfaces\JRParameterInterface;
use App\Http\Requests\JR\JRFormRequest;
use App\Http\Requests\JR\JRFilterRequest;
use App\Http\Requests\JR\JRSetJRNoFormRequest;


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



    
    public function euIndex(JRFilterRequest $request){

        $jr_list = $this->jr_repo->fetchByDeptId($this->auth->user()->dept_id, $request);
        $request->flash();
        return view('dashboard.jr.eu_index')->with('jr_list', $jr_list);

    }

    


    public function create(){
        return view('dashboard.jr.create');
    }

    


    public function euCreate(){
        return view('dashboard.jr.eu_create');
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

        $jr = $this->jr_repo->findbySlug($slug);
        return view('dashboard.jr.edit')->with('jr', $jr);

    }
 



    public function euEdit($slug){

        $jr = $this->jr_repo->findbySlug($slug);
        return view('dashboard.jr.eu_edit')->with('jr', $jr);

    }
 



    public function show($slug){

        $jr = $this->jr_repo->findbySlug($slug);
        return view('dashboard.jr.show')->with('jr', $jr);

    }
 



    public function jrint($slug, $page){

        $jr = $this->jr_repo->findbySlug($slug);

        if ($page == 'FRONT') {
            return view('jrintables.jr.jr_form_front')->with('jr', $jr);
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

        if ($request->type == 'M') {
            return redirect()->route('dashboard.jr.index');
        }elseif ($request->type == 'EU') {
            return redirect()->route('dashboard.jr.eu_index');
        }
        

    }

    


    public function destroy($slug){

        $jr = $this->jr_repo->destroy($slug);
        $this->event->fire('jr.destroy', $jr);
        return redirect()->back();

    }

    


    public function setJRNO(JRSetJRNoFormRequest $request, $slug){

        $jr = $this->jr_repo->updateJRNo($request, $slug);
        $this->event->fire('jr.set_jr_no', $jr);
        return redirect()->back();

    }



    
}
