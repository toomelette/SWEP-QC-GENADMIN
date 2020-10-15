<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\POInterface;
use App\Core\Interfaces\POParameterInterface;
use App\Http\Requests\PO\POFormRequest;
use App\Http\Requests\PO\POFilterRequest;
use App\Http\Requests\PO\POSetPONoFormRequest;


class POController extends Controller{


    protected $po_repo;
    protected $po_parameter_repo;


    public function __construct(POInterface $po_repo, POParameterInterface $po_parameter_repo){
        $this->po_repo = $po_repo;
        $this->po_parameter_repo = $po_parameter_repo;
        parent::__construct();
    }



    
    public function index(POFilterRequest $request){

        $po_list = $this->po_repo->fetch($request);
        $request->flash();
        return view('dashboard.po.index')->with('po_list', $po_list);

    }



    
    public function euIndex(POFilterRequest $request){

        $po_list = $this->po_repo->fetchByDeptId($this->auth->user()->dept_id, $request);
        $request->flash();
        return view('dashboard.po.eu_index')->with('po_list', $po_list);

    }

    


    public function create(){
        return view('dashboard.po.create');
    }

    


    public function euCreate(){
        return view('dashboard.po.eu_create');
    }


   

    public function store(POFormRequest $request){

        $po = $this->po_repo->store($request);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $po_parameter = $this->po_parameter_repo->store($row, $po);
            }
        }

        $this->event->fire('po.store', $po);
        return redirect()->back();

    }
 



    public function edit($slug){

        $po = $this->po_repo->findbySlug($slug);
        return view('dashboard.po.edit')->with('po', $po);

    }
 



    public function euEdit($slug){

        $po = $this->po_repo->findbySlug($slug);
        return view('dashboard.po.eu_edit')->with('po', $po);

    }
 



    public function show($slug){

        $po = $this->po_repo->findbySlug($slug);
        return view('dashboard.po.show')->with('po', $po);

    }
 



    public function print($slug, $page){

        $po = $this->po_repo->findbySlug($slug);

        if ($page == 'FRONT') {
            return view('printables.po.po_form_front')->with('po', $po);
        }elseif ($page == 'BACK') {
            return view('printables.po.po_form_back');
        }else{
            abort(404);
        }

    }




    public function update(POFormRequest $request, $slug){

        $po = $this->po_repo->update($request, $slug);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $po_parameter = $this->po_parameter_repo->store($row, $po);
            }
        }
        
        $this->event->fire('po.update', $po);

        if ($request->type == 'M') {
            return redirect()->route('dashboard.po.index');
        }elseif ($request->type == 'EU') {
            return redirect()->route('dashboard.po.eu_index');
        }

    }

    


    public function destroy($slug){

        $po = $this->po_repo->destroy($slug);
        $this->event->fire('po.destroy', $po);
        return redirect()->back();

    }

    


    public function setPONO(POSetPONoFormRequest $request, $slug){

        $po = $this->po_repo->updatePONo($request, $slug);
        $this->event->fire('po.set_po_no', $po);
        return redirect()->back();

    }



    
}
