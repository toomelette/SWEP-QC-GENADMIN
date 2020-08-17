<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\DepartmentInterface;

use App\Models\Department;


class DepartmentRepository extends BaseRepository implements DepartmentInterface {
	

    protected $department;


	public function __construct(Department $department){

        $this->department = $department;
        parent::__construct();

    }




    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $departments = $this->cache->remember('departments:fetch:' . $key, 240, function() use ($request, $entries){

            $department = $this->department->newQuery();
            
            if(isset($request->q)){
                $department->where('name', 'LIKE', '%'. $request->q .'%')
                           ->orWhere('acronym', 'LIKE', '%'. $request->q .'%');
            }

            return $department->select('name', 'slug')
                        ->sortable()
                        ->orderBy('updated_at', 'asc')
                        ->paginate($entries);

        });

        return $departments;

    }




    public function store($request){

        $department = new Department;
        $department->dept_id = $this->getDepartmentIdInc();
        $department->slug = $this->str->random(16);
        $department->name = $request->name;
        $department->acronym = $request->acronym;
        $department->created_at = $this->carbon->now();
        $department->updated_at = $this->carbon->now();
        $department->ip_created = request()->ip();
        $department->ip_updated = request()->ip();
        $department->user_created = $this->auth->user()->user_id;
        $department->user_updated = $this->auth->user()->user_id;
        $department->save();
        
        return $department;

    }




    public function update($request, $slug){

        $department = $this->findBySlug($slug);
        $department->name = $request->name;
        $department->acronym = $request->acronym;
        $department->updated_at = $this->carbon->now();
        $department->ip_updated = request()->ip();
        $department->user_updated = $this->auth->user()->user_id;
        $department->save();
        
        return $department;

    }




    public function destroy($slug){

        $department = $this->findBySlug($slug);
        $department->delete();

        return $department;

    }




    public function findBySlug($slug){

        $department = $this->cache->remember('departments:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->department->where('slug', $slug)->first();
        }); 
        
        if(empty($department)){
            abort(404);
        }

        return $department;

    }




    public function getDepartmentIdInc(){

        $id = 'D1001';
        $department = $this->department->select('dept_id')->orderBy('dept_id', 'desc')->first();

        if($department != null){
            if($department->dept_id != null){
                $num = str_replace('D', '', $department->dept_id) + 1;
                $id = 'D' . $num;
            }
        }
        
        return $id;
        
    }




    public function getAll(){

        $departments = $this->cache->remember('departments:getAll', 240, function(){
            return $this->department->select('dept_id', 'name')->get();
        });
        
        return $departments;

    }




}