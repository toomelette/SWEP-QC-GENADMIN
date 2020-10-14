<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\PRInterface;
use App\Core\Interfaces\PRParameterInterface;
use App\Http\Requests\PR\PRFormRequest;
use App\Http\Requests\PR\PRFilterRequest;
use App\Http\Requests\PR\PRSetPRNoFormRequest;


class PRController extends Controller{



    protected $pr_repo;
    protected $pr_parameter_repo;



    public function __construct(PRInterface $pr_repo, PRParameterInterface $pr_parameter_repo){
        $this->pr_repo = $pr_repo;
        $this->pr_parameter_repo = $pr_parameter_repo;
        parent::__construct();
    }



    
    public function index(PRFilterRequest $request){

        $pr_list = $this->pr_repo->fetch($request);
        $request->flash();
        return view('dashboard.pr.index')->with('pr_list', $pr_list);

    }



    
    public function euIndex(PRFilterRequest $request){

        $pr_list = $this->pr_repo->fetchByDeptId($this->auth->user()->dept_id, $request);
        $request->flash();
        return view('dashboard.pr.eu_index')->with('pr_list', $pr_list);

    }

    


    public function create(){
        return view('dashboard.pr.create');
    }

    


    public function euCreate(){
        return view('dashboard.pr.eu_create');
    }


   

    public function store(PRFormRequest $request){

        $pr = $this->pr_repo->store($request);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $pr_parameter = $this->pr_parameter_repo->store($row, $pr);
            }
        }

        $this->event->fire('pr.store', $pr);
        return redirect()->back();

    }
 



    public function edit($slug){

        $pr = $this->pr_repo->findbySlug($slug);
        return view('dashboard.pr.edit')->with('pr', $pr);

    }
 



    public function euEdit($slug){

        $pr = $this->pr_repo->findbySlug($slug);
        return view('dashboard.pr.eu_edit')->with('pr', $pr);

    }
 



    public function show($slug){

        $pr = $this->pr_repo->findbySlug($slug);
        return view('dashboard.pr.show')->with('pr', $pr);

    }
 



    public function print($slug, $page){

        $pr = $this->pr_repo->findbySlug($slug);

        if ($page == 'FRONT') {
            return view('printables.pr.pr_form_front')->with('pr', $pr);
        }elseif ($page == 'BACK') {
            return view('printables.pr.pr_form_back');
        }

    }




    public function update(PRFormRequest $request, $slug){

        $pr = $this->pr_repo->update($request, $slug);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $pr_parameter = $this->pr_parameter_repo->store($row, $pr);
            }
        }
        
        $this->event->fire('pr.update', $pr);

        if ($request->type == 'M') {
            return redirect()->route('dashboard.pr.index');
        }elseif ($request->type == 'EU') {
            return redirect()->route('dashboard.pr.eu_index');
        }
        

    }

    


    public function destroy($slug){

        $pr = $this->pr_repo->destroy($slug);
        $this->event->fire('pr.destroy', $pr);
        return redirect()->back();

    }

    


    public function setPRNO(PRSetPRNoFormRequest $request, $slug){

        $pr = $this->pr_repo->updatePRNo($request, $slug);
        $this->event->fire('pr.set_pr_no', $pr);
        return redirect()->back();

    }



    
}
