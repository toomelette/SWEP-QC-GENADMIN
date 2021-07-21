<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\PRInterface;

use App\Models\PR;


class PRRepository extends BaseRepository implements PRInterface {
	

    protected $pr;


	public function __construct(PR $pr){

        $this->pr = $pr;
        parent::__construct();

    }




    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $pr_list = $this->cache->remember('pr:fetch:' . $key, 240, function() use ($request, $entries){

            $pr = $this->pr->newQuery();

            if (isset($request->dept)) {
                $pr->where('dept_id', $request->dept);
            }

            if (isset($request->div)) {
                $pr->where('div_id', $request->div);
            }
            
            if(isset($request->q)){
                $pr->where('pr_no', 'LIKE', '%'. $request->q .'%')
                   ->orWhere('sai_no', 'LIKE', '%'. $request->q .'%')
                   ->orwhereHas('prParameter', function ($model) use ($request) {
                        $model->where('item_name', 'LIKE', '%'. $request->q .'%');
                   });
            }

            return $pr->select('pr_id', 'dept_id', 'div_id', 'pr_no', 'pr_no_date', 'sai_no', 'sai_no_date', 'created_at', 'slug')
                      ->with('department', 'division', 'prParameter')
                      ->sortable()
                      ->orderBy('updated_at', 'desc')
                      ->paginate($entries);

        });

        return $pr_list;

    }




    public function fetchByDeptId($dept_id, $request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $pr_list = $this->cache->remember('pr:fetchByDeptId:'.$dept_id.':' . $key, 240, function() use ($dept_id, $request, $entries){

            $pr = $this->pr->newQuery();
            
            if(isset($request->q)){
                $pr->where('pr_no', 'LIKE', '%'. $request->q .'%')
                   ->orWhere('sai_no', 'LIKE', '%'. $request->q .'%')
                   ->orwhereHas('prParameter', function ($model) use ($request) {
                        $model->where('item_name', 'LIKE', '%'. $request->q .'%');
                   });
            }

            return $pr->select('pr_id', 'div_id', 'pr_no', 'created_at', 'slug')
                      ->where('dept_id', $dept_id)
                      ->with('division', 'prParameter')
                      ->sortable()
                      ->orderBy('updated_at', 'desc')
                      ->paginate($entries);

        });

        return $pr_list;

    }




    public function getList($request){

        $pr = $this->pr->newQuery();
        
        if(isset($request->dept)){
            $pr->where('dept_id', $request->dept);
        }

        if(isset($request->df) && isset($request->dt)){
            $df = $this->__dataType->date_parse($request->df, 'Y-m-d');
            $dt = $this->__dataType->date_parse($request->dt, 'Y-m-d');
            $pr->whereBetween('created_at', [$df,$dt]);
        }

        return $pr->select('pr_id', 'dept_id', 'pr_no', 'updated_at', 'created_at')
                  ->with('department', 'prParameter')
                  ->orderBy('updated_at', 'desc')
                  ->get();

    }




    public function store($request){

        $pr = new PR;
        $pr->slug = $this->str->random(16);
        $pr->pr_id = $this->getPRIdInc();
        $pr->dept_id = $request->dept_id;
        $pr->div_id = $request->div_id;
        $pr->pr_no = $request->pr_no;
        $pr->sai_no = $request->sai_no;
        $pr->sai_no_date = $this->__dataType->date_parse($request->sai_no_date);
        $pr->purpose = nl2br($request->purpose);
        $pr->req_by_name = $request->req_by_name;
        $pr->req_by_designation = $request->req_by_designation;
        $pr->appr_by_name = $request->appr_by_name;
        $pr->appr_by_designation = $request->appr_by_designation;
        $pr->created_at = $this->carbon->now();
        $pr->updated_at = $this->carbon->now();
        $pr->ip_created = request()->ip();
        $pr->ip_updated = request()->ip();
        $pr->user_created = $this->auth->user()->user_id;
        $pr->user_updated = $this->auth->user()->user_id;
        $pr->save();
        
        return $pr;

    }




    public function update($request, $slug){

        $pr = $this->findBySlug($slug);
        $pr->dept_id = $request->dept_id;
        $pr->div_id = $request->div_id;

        if($request->has('pr_no')){
            $pr->pr_no = $request->pr_no;
        }

        if($request->has('pr_no_date')){
            $pr->pr_no_date = $this->__dataType->date_parse($request->pr_no_date);
        }

        if($request->has('sai_no')){
            $pr->sai_no = $request->sai_no;
        }

        if($request->has('sai_no_date')){
            $pr->sai_no_date = $this->__dataType->date_parse($request->sai_no_date);
        }

        $pr->purpose = nl2br($request->purpose);
        $pr->req_by_name = $request->req_by_name;
        $pr->req_by_designation = $request->req_by_designation;
        $pr->appr_by_name = $request->appr_by_name;
        $pr->appr_by_designation = $request->appr_by_designation;
        $pr->updated_at = $this->carbon->now();
        $pr->ip_updated = request()->ip();
        $pr->user_updated = $this->auth->user()->user_id;
        $pr->save();

        $pr->prParameter()->delete();
        
        return $pr;

    }




    public function updatePRNo($request, $slug){

        $pr = $this->findBySlug($slug);
        $pr->pr_no = $request->pr_no;
        $pr->pr_no_date = $this->carbon->now();
        $pr->sai_no = $request->sai_no;
        $pr->updated_at = $this->carbon->now();
        $pr->ip_updated = request()->ip();
        $pr->user_updated = $this->auth->user()->user_id;
        $pr->save();
        
        return $pr;

    }




    public function destroy($slug){

        $pr = $this->findBySlug($slug);
        $pr->delete();
        $pr->prParameter()->delete();
        return $pr;

    }




    public function findBySlug($slug){

        $pr = $this->cache->remember('pr:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->pr->where('slug', $slug)
                            ->with('prParameter', 'department', 'division')
                            ->first();
        }); 
        
        if(empty($pr)){
            abort(404);
        }

        return $pr;

    }




    public function getPRIdInc(){

        $id = 'PR1001';
        $pr = $this->pr->select('pr_id')->orderBy('pr_id', 'desc')->first();

        if($pr != null){
            if($pr->pr_id != null){
                $num = str_replace('PR', '', $pr->pr_id) + 1;
                $id = 'PR' . $num;
            }
        }
        
        return $id;
        
    }



}