<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\JOInterface;
use App\Core\Interfaces\JOParameterInterface;
use App\Http\Requests\JO\JOFormRequest;
use App\Http\Requests\JO\JOFilterRequest;
use App\Http\Requests\JO\JOSetJONoFormRequest;


class JOController extends Controller{


    protected $jo_repo;


    public function __construct(JOInterface $jo_repo){
        $this->jo_repo = $jo_repo;
        parent::__construct();
    }



    
    public function index(JOFilterRequest $request){

        $jo_list = $this->jo_repo->fetch($request);
        $request->flash();
        return view('dashboard.jo.index')->with('jo_list', $jo_list);

    }



    
    public function euIndex(JOFilterRequest $request){

        $jo_list = $this->jo_repo->fetchByDeptId($this->auth->user()->dept_id, $request);
        $request->flash();
        return view('dashboard.jo.eu_index')->with('jo_list', $jo_list);

    }

    


    public function create(){
        return view('dashboard.jo.create');
    }

    


    public function euCreate(){
        return view('dashboard.jo.eu_create');
    }


   

    public function store(JOFormRequest $request){

        $jo = $this->jo_repo->store($request);

        $this->event->fire('jo.store', $jo);
        return redirect()->back();

    }
 



    public function edit($slug){

        $jo = $this->jo_repo->findbySlug($slug);
        return view('dashboard.jo.edit')->with('jo', $jo);

    }
 



    public function euEdit($slug){

        $jo = $this->jo_repo->findbySlug($slug);
        return view('dashboard.jo.eu_edit')->with('jo', $jo);

    }
 



    public function show($slug){

        $jo = $this->jo_repo->findbySlug($slug);
        return view('dashboard.jo.show')->with('jo', $jo);

    }
 



    public function print($slug, $page){

        $jo = $this->jo_repo->findbySlug($slug);

        if ($page == 'FRONT') {
            return view('printables.jo.jo_form_front')->with('jo', $jo);
        }elseif ($page == 'BACK') {
            return view('printables.jo.jo_form_back');
        }else{
            abort(404);
        }

    }




    public function update(JOFormRequest $request, $slug){

        $jo = $this->jo_repo->update($request, $slug);
        
        $this->event->fire('jo.update', $jo);

        if ($request->type == 'M') {
            return redirect()->route('dashboard.jo.index');
        }elseif ($request->type == 'EU') {
            return redirect()->route('dashboard.jo.eu_index');
        }else{
            abort(404);
        }

    }

    


    public function destroy($slug){

        $jo = $this->jo_repo->destroy($slug);
        $this->event->fire('jo.destroy', $jo);
        return redirect()->back();

    }

    


    public function setJONO(JOSetJONoFormRequest $request, $slug){

        $jo = $this->jo_repo->updateJONo($request, $slug);
        $this->event->fire('jo.set_jo_no', $jo);
        return redirect()->back();

    }



    
}
