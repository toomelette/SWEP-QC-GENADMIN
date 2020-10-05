<?php

namespace App\Http\Controllers;


// use App\Core\Interfaces\JOInterface;
// use App\Core\Interfaces\JOParameterInterface;
// use App\Http\Requests\JO\JOFormRequest;
// use App\Http\Requests\JO\JOFilterRequest;


class JOController extends Controller{


    // protected $jo_repo;


    // public function __construct(JOInterface $jo_repo){
    //     $this->jo_repo = $jo_repo;
    //     parent::__construct();
    // }



    
    // public function index(JOFilterRequest $request){

    //     $jo_list = $this->jo_repo->fetch($request);
    //     $request->flash();
    //     return view('dashboard.jo.index')->with('jo_list', $jo_list);

    // }

    


    public function create(){
        return view('dashboard.jo.create');
    }


   

    // public function store(JOFormRequest $request){

    //     $jo = $this->jo_repo->store($request);

    //     $this->event->fire('jo.store', $jo);
    //     return redirect()->back();

    // }
 



    // public function edit($slug){

    //     $jo = $this->jo_repo->findbySlug($slug);
    //     return view('dashboard.jo.edit')->with('po', $jo);

    // }
 



    // public function show($slug){

    //     $jo = $this->jo_repo->findbySlug($slug);
    //     return view('dashboard.jo.show')->with('po', $jo);

    // }
 



    // public function print($slug, $page){

    //     $jo = $this->jo_repo->findbySlug($slug);

    //     if ($page == 'FRONT') {
    //         return view('printables.jo.po_form_front')->with('po', $jo);
    //     }elseif ($page == 'BACK') {
    //         return view('printables.jo.po_form_back');
    //     }else{
    //         abort(404);
    //     }

    // }




    // public function update(JOFormRequest $request, $slug){

    //     $jo = $this->jo_repo->update($request, $slug);
        
    //     $this->event->fire('jo.update', $jo);
    //     return redirect()->route('dashboard.jo.index');

    // }

    


    // public function destroy($slug){

    //     $jo = $this->jo_repo->destroy($slug);
    //     $this->event->fire('jo.destroy', $jo);
    //     return redirect()->back();

    // }



    
}
