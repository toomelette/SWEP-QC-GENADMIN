<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\PRInterface;
use App\Http\Requests\PR\PRFormRequest;
use App\Http\Requests\PR\PRFilterRequest;


class PRController extends Controller{


    protected $pr_repo;


    public function __construct(PRInterface $pr_repo){
        $this->pr_repo = $pr_repo;
        parent::__construct();
    }



    
    public function index(PRFilterRequest $request){

        $pr_list = $this->pr_repo->fetch($request);
        $request->flash();
        return view('dashboard.pr.index')->with('pr_list', $pr_list);

    }

    


    public function create(){
        return view('dashboard.pr.create');
    }


   

    public function store(PRFormRequest $request){

        $pr = $this->pr_repo->store($request);
        $this->event->fire('pr.store');
        return redirect()->back();

    }
 



    public function edit($slug){

        $pr = $this->pr_repo->findbySlug($slug);
        return view('dashboard.pr.edit')->with('pr', $pr);

    }




    public function update(PRFormRequest $request, $slug){

        $pr = $this->pr_repo->update($request, $slug);
        $this->event->fire('pr.update', $pr);
        return redirect()->route('dashboard.pr.index');

    }

    


    public function destroy($slug){

        $pr = $this->pr_repo->destroy($slug);
        $this->event->fire('pr.destroy', $pr);
        return redirect()->back();

    }



    
}
