<?php

namespace App\Http\Controllers;
use App\Core\Repositories\DepartmentRepository;
use App\Core\Repositories\PRRepository;
use App\Core\Repositories\JRRepository;
use App\Http\Requests\Reports\PRJRListingsRequest;

class ReportsController extends Controller{


    protected $dept_repo;
    protected $pr_repo;
    protected $jr_repo;


    public function __construct(DepartmentRepository $dept_repo, PRRepository $pr_repo, JRRepository $jr_repo){

        $this->dept_repo = $dept_repo;
        $this->pr_repo = $pr_repo;
        $this->jr_repo = $jr_repo;
        parent::__construct();

    }


	public function prjr(){
        return view('dashboard.reports.prjr');
    }


	public function prjrOutput(PRJRListingsRequest $request){

        $dept_name = "";

        if(isset($request->dept)){
            $dept = $this->dept_repo->findByDeptId($request->dept);
            $dept_name = $dept->name;
        }
        
        $pr_list = $this->pr_repo->getList($request);
        $jr_list = $this->jr_repo->getList($request);

        return view('printables.reports.prjr_listings')->with([
            'dept_name' => $dept_name,
            'pr_list' => $pr_list,
            'jr_list' => $jr_list,
        ]);

    }


}
