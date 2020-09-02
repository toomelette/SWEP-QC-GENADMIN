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




    // public function fetch($request){

    //     $key = str_slug($request->fullUrl(), '_');
    //     $entries = isset($request->e) ? $request->e : 20;

    //     $pr_list = $this->cache->remember('pr:fetch:' . $key, 240, function() use ($request, $entries){

    //         $pr = $this->pr->newQuery();
            
    //         if(isset($request->q)){
    //             $pr->where('name', 'LIKE', '%'. $request->q .'%')
    //                        ->orWhere('acronym', 'LIKE', '%'. $request->q .'%');
    //         }

    //         return $pr->select('name', 'slug')
    //                     ->sortable()
    //                     ->orderBy('updated_at', 'asc')
    //                     ->paginate($entries);

    //     });

    //     return $pr_list;

    // }




    public function store($request){

        $pr = new PR;
        $pr->slug = $this->str->random(16);
        $pr->pr_id = $this->getPRIdInc();
        $pr->dept_id = $this->auth->user()->dept_id;
        $pr->div_id = $this->auth->user()->div_id;
        $pr->pr_no = $request->pr_no;
        $pr->pr_no_date = $this->__dataType->date_parse($request->pr_no_date);
        $pr->sai_no = $request->sai_no;
        $pr->sai_no_date = $this->__dataType->date_parse($request->sai_no_date);
        $pr->purpose = $request->purpose;
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




    // public function update($request, $slug){

    //     $pr = $this->findBySlug($slug);
    //     $pr->name = $request->name;
    //     $pr->acronym = $request->acronym;
    //     $pr->updated_at = $this->carbon->now();
    //     $pr->ip_updated = request()->ip();
    //     $pr->user_updated = $this->auth->user()->user_id;
    //     $pr->save();
        
    //     return $pr;

    // }




    // public function destroy($slug){

    //     $pr = $this->findBySlug($slug);
    //     $pr->delete();

    //     return $pr;

    // }




    // public function findBySlug($slug){

    //     $pr = $this->cache->remember('pr:findBySlug:' . $slug, 240, function() use ($slug){
    //         return $this->pr->where('slug', $slug)->first();
    //     }); 
        
    //     if(empty($pr)){
    //         abort(404);
    //     }

    //     return $pr;

    // }




    // public function getAll(){

    //     $pr_list = $this->cache->remember('pr:getAll', 240, function(){
    //         return $this->pr->select('pr_id', 'name')->get();
    //     });
        
    //     return $pr_list;

    // }




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