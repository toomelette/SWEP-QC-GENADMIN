<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\JRInterface;

use App\Models\JR;


class JRRepository extends BaseRepository implements JRInterface {
	

    protected $jr;


	public function __construct(JR $jr){

        $this->jr = $jr;
        parent::__construct();

    }




    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $jr_list = $this->cache->remember('jr:fetch:' . $key, 240, function() use ($request, $entries){

            $jr = $this->jr->newQuery();

            if (isset($request->dept)) {
                $jr->where('dept_id', $request->dept);
            }

            if (isset($request->div)) {
                $jr->where('div_id', $request->div);
            }
            
            if(isset($request->q)){
                $jr->where('jr_no', 'LIKE', '%'. $request->q .'%')
                   ->orwhereHas('jrParameter', function ($model) use ($request) {
                        $model->where('item_name', 'LIKE', '%'. $request->q .'%');
                   });
            }

            return $jr->select('jr_id', 'dept_id', 'div_id', 'jr_no', 'date', 'created_at', 'slug')
                      ->with('department', 'division', 'jrParameter')
                      ->sortable()
                      ->orderBy('updated_at', 'desc')
                      ->paginate($entries);

        });

        return $jr_list;

    }




    public function fetchByDeptId($dept_id, $request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $jr_list = $this->cache->remember('jr:fetchByDeptId:'.$dept_id.':' . $key, 240, function() use ($dept_id, $request, $entries){

            $jr = $this->jr->newQuery();
            
            if(isset($request->q)){
                $jr->where('jr_no', 'LIKE', '%'. $request->q .'%')
                   ->orwhereHas('jrParameter', function ($model) use ($request) {
                        $model->where('item_name', 'LIKE', '%'. $request->q .'%');
                   });
            }

            return $jr->select('jr_id', 'div_id', 'jr_no', 'created_at', 'slug')
                      ->where('dept_id', $dept_id)
                      ->with('division', 'jrParameter')
                      ->sortable()
                      ->orderBy('updated_at', 'desc')
                      ->paginate($entries);

        });

        return $jr_list;

    }




    public function store($request){

        $jr = new JR;
        $jr->slug = $this->str->random(16);
        $jr->jr_id = $this->getJRIdInc();
        $jr->dept_id = $request->dept_id;
        $jr->div_id = $request->div_id;
        $jr->jr_no = $request->jr_no;
        $jr->date = $this->__dataType->date_parse($request->date);
        $jr->purpose = nl2br($request->purpose);
        $jr->req_by_name = $request->req_by_name;
        $jr->req_by_designation = $request->req_by_designation;
        $jr->appr_by_name = $request->appr_by_name;
        $jr->appr_by_designation = $request->appr_by_designation;
        $jr->created_at = $this->carbon->now();
        $jr->updated_at = $this->carbon->now();
        $jr->ip_created = request()->ip();
        $jr->ip_updated = request()->ip();
        $jr->user_created = $this->auth->user()->user_id;
        $jr->user_updated = $this->auth->user()->user_id;
        $jr->save();
        
        return $jr;

    }




    public function update($request, $slug){

        $jr = $this->findBySlug($slug);
        $jr->dept_id = $request->dept_id;
        $jr->div_id = $request->div_id;

        if($request->has('jr_no')){
            $jr->jr_no = $request->jr_no;
        }

        if($request->has('date')){
            $jr->date = $this->__dataType->date_parse($request->date);
        }

        $jr->purpose = nl2br($request->purpose);
        $jr->req_by_name = $request->req_by_name;
        $jr->req_by_designation = $request->req_by_designation;
        $jr->appr_by_name = $request->appr_by_name;
        $jr->appr_by_designation = $request->appr_by_designation;
        $jr->updated_at = $this->carbon->now();
        $jr->ip_updated = request()->ip();
        $jr->user_updated = $this->auth->user()->user_id;
        $jr->save();

        $jr->jrParameter()->delete();
        
        return $jr;

    }




    public function updateJRNo($request, $slug){

        $jr = $this->findBySlug($slug);
        $jr->jr_no = $request->jr_no;
        $jr->updated_at = $this->carbon->now();
        $jr->ip_updated = request()->ip();
        $jr->user_updated = $this->auth->user()->user_id;
        $jr->save();
        
        return $jr;

    }




    public function destroy($slug){

        $jr = $this->findBySlug($slug);
        $jr->delete();

        $jr->jrParameter()->delete();

        return $jr;

    }




    public function findBySlug($slug){

        $jr = $this->cache->remember('jr:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->jr->where('slug', $slug)
                            ->with('jrParameter', 'department', 'division')
                            ->first();
        }); 
        
        if(empty($jr)){
            abort(404);
        }

        return $jr;

    }




    public function getJRIdInc(){

        $id = 'JR1001';
        $jr = $this->jr->select('jr_id')->orderBy('jr_id', 'desc')->first();

        if($jr != null){
            if($jr->jr_id != null){
                $num = str_replace('JR', '', $jr->jr_id) + 1;
                $id = 'JR' . $num;
            }
        }
        
        return $id;
        
    }




    public function getAll(){

        $jr = $this->cache->remember('jr:getAll', 240, function(){
            return $this->jr->select('jr_id', 'jr_no')->get();
        });
        
        return $jr;

    }




}