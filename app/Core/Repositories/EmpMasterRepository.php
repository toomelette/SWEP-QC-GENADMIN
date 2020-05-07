<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\EmpMasterInterface;

use App\Models\EmpMaster;


class EmpMasterRepository extends BaseRepository implements EmpMasterInterface {
	

    protected $emp_master;


	public function __construct(EmpMaster $emp_master){

        $this->emp_master = $emp_master;
        parent::__construct();

    }




    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $employees = $this->cache->remember('emp_master:fetch:' . $key, 240, function() use ($request, $entries){

            $emp_master = $this->emp_master->newQuery();
            
            if(isset($request->q)){
                $emp_master->where('emp_no', 'LIKE', '%'. $request->q .'%')
                           ->orWhere('firstname', 'LIKE', '%'. $request->q .'%')
                           ->orWhere('middlename', 'LIKE', '%'. $request->q .'%')
                           ->orWhere('lastname', 'LIKE', '%'. $request->q .'%');
            }

            return $emp_master->select('emp_no', 'firstname', 'middlename', 'lastname', 'suffixname', 'position', 'slug')
                        ->sortable()
                        ->orderBy('created_at', 'desc')
                        ->paginate($entries);

        });

        return $employees;

    }




    // public function store($request){

    //     $emp_master = new EmpMaster;
    //     $emp_master->emp_master_id = $this->getEmpMasterIdInc();
    //     $emp_master->slug = $this->str->random(16);
    //     $emp_master->name = $request->name;
    //     $emp_master->route = $request->route;
    //     $emp_master->icon = $request->icon;
    //     $emp_master->is_emp_master = $this->__dataType->string_to_boolean($request->is_emp_master);
    //     $emp_master->is_dropdown = $this->__dataType->string_to_boolean($request->is_dropdown);
    //     $emp_master->created_at = $this->carbon->now();
    //     $emp_master->updated_at = $this->carbon->now();
    //     $emp_master->ip_created = request()->ip();
    //     $emp_master->ip_updated = request()->ip();
    //     $emp_master->user_created = $this->auth->user()->user_id;
    //     $emp_master->user_updated = $this->auth->user()->user_id;
    //     $emp_master->save();
        
    //     return $emp_master;

    // }




    // public function update($request, $slug){

    //     $emp_master = $this->findBySlug($slug);
    //     $emp_master->name = $request->name;
    //     $emp_master->route = $request->route;
    //     $emp_master->icon = $request->icon;
    //     $emp_master->is_emp_master = $this->__dataType->string_to_boolean($request->is_emp_master);
    //     $emp_master->is_dropdown = $this->__dataType->string_to_boolean($request->is_dropdown);
    //     $emp_master->updated_at = $this->carbon->now();
    //     $emp_master->ip_updated = request()->ip();
    //     $emp_master->user_updated = $this->auth->user()->user_id;
    //     $emp_master->save();

    //     $emp_master->subemp_master()->delete();
        
    //     return $emp_master;

    // }




    // public function destroy($slug){

    //     $emp_master = $this->findBySlug($slug);
    //     $emp_master->delete();
    //     $emp_master->subemp_master()->delete();

    //     return $emp_master;

    // }




    public function findBySlug($slug){

        $employee = $this->cache->remember('emp_master:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->emp_master->where('slug', $slug)->first();
        }); 
        
        if(empty($employee)){
            abort(404);
        }

        return $employee;

    }




    // public function findByEmpMasterId($emp_master_id){

    //     $emp_master = $this->cache->remember('emp_masters:findByEmpMasterId:' . $emp_master_id, 240, function() use ($emp_master_id){
    //         return $this->emp_master->where('emp_master_id', $emp_master_id)->first();
    //     });
        
    //     if(empty($emp_master)){
    //         abort(404);
    //     }
        
    //     return $emp_master;

    // }




    // public function getEmpMasterIdInc(){

    //     $id = 'M10001';
    //     $emp_master = $this->emp_master->select('emp_master_id')->orderBy('emp_master_id', 'desc')->first();

    //     if($emp_master != null){
    //         if($emp_master->emp_master_id != null){
    //             $num = str_replace('M', '', $emp_master->emp_master_id) + 1;
    //             $id = 'M' . $num;
    //         }
    //     }
        
    //     return $id;
        
    // }




    // public function getAll(){

    //     $emp_masters = $this->cache->remember('emp_masters:getAll', 240, function(){
    //         return $this->emp_master->select('emp_master_id', 'name')
    //                           ->with('subemp_master')
    //                           ->get();
    //     });
        
    //     return $emp_masters;

    // }




}