<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\EmpHealthInterface;

use App\Models\EmpHealth;


class EmpHealthRepository extends BaseRepository implements EmpHealthInterface {
	

    protected $emp_health;


	public function __construct(EmpHealth $emp_health){

        $this->emp_health = $emp_health;
        parent::__construct();

    }




    // public function fetch($request){

    //     $key = str_slug($request->fullUrl(), '_');
    //     $entries = isset($request->e) ? $request->e : 20;

    //     $emp_healths = $this->cache->remember('emp_healths:fetch:' . $key, 240, function() use ($request, $entries){

    //         $emp_health = $this->emp_health->newQuery();
            
    //         if(isset($request->q)){
    //             $emp_health->where('name', 'LIKE', '%'. $request->q .'%');
    //         }

    //         return $emp_health->select('name', 'route', 'icon', 'slug')
    //                     ->sortable()
    //                     ->orderBy('updated_at', 'desc')
    //                     ->paginate($entries);

    //     });

    //     return $emp_healths;

    // }




    public function store($request){

        $emp_health = new EmpHealth;
        $emp_health->emp_health_id = $this->getEmpHealthIdInc();
        $emp_health->slug = $this->str->random(16);
        $emp_health->name = $request->name;
        $emp_health->route = $request->route;
        $emp_health->icon = $request->icon;
        $emp_health->is_emp_health = $this->__dataType->string_to_boolean($request->is_emp_health);
        $emp_health->is_dropdown = $this->__dataType->string_to_boolean($request->is_dropdown);
        $emp_health->created_at = $this->carbon->now();
        $emp_health->updated_at = $this->carbon->now();
        $emp_health->ip_created = request()->ip();
        $emp_health->ip_updated = request()->ip();
        $emp_health->user_created = $this->auth->user()->user_id;
        $emp_health->user_updated = $this->auth->user()->user_id;
        $emp_health->save();
        
        return $emp_health;

    }




    // public function update($request, $slug){

    //     $emp_health = $this->findBySlug($slug);
    //     $emp_health->name = $request->name;
    //     $emp_health->route = $request->route;
    //     $emp_health->icon = $request->icon;
    //     $emp_health->is_emp_health = $this->__dataType->string_to_boolean($request->is_emp_health);
    //     $emp_health->is_dropdown = $this->__dataType->string_to_boolean($request->is_dropdown);
    //     $emp_health->updated_at = $this->carbon->now();
    //     $emp_health->ip_updated = request()->ip();
    //     $emp_health->user_updated = $this->auth->user()->user_id;
    //     $emp_health->save();

    //     $emp_health->subemp_health()->delete();
        
    //     return $emp_health;

    // }




    // public function destroy($slug){

    //     $emp_health = $this->findBySlug($slug);
    //     $emp_health->delete();
    //     $emp_health->subemp_health()->delete();

    //     return $emp_health;

    // }




    // public function findBySlug($slug){

    //     $emp_health = $this->cache->remember('emp_healths:findBySlug:' . $slug, 240, function() use ($slug){
    //         return $this->emp_health->where('slug', $slug)->first();
    //     }); 
        
    //     if(empty($emp_health)){
    //         abort(404);
    //     }

    //     return $emp_health;

    // }




    // public function findByEmpHealthId($emp_health_id){

    //     $emp_health = $this->cache->remember('emp_healths:findByEmpHealthId:' . $emp_health_id, 240, function() use ($emp_health_id){
    //         return $this->emp_health->where('emp_health_id', $emp_health_id)->first();
    //     });
        
    //     if(empty($emp_health)){
    //         abort(404);
    //     }
        
    //     return $emp_health;

    // }




    public function getEmpHealthIdInc(){

        $id = 'EH10001';
        $emp_health = $this->emp_health->select('emp_health_id')->orderBy('emp_health_id', 'desc')->first();

        if($emp_health != null){
            if($emp_health->emp_health_id != null){
                $num = str_replace('EH', '', $emp_health->emp_health_id) + 1;
                $id = 'EH' . $num;
            }
        }
        
        return $id;
        
    }




    // public function getAll(){

    //     $emp_healths = $this->cache->remember('emp_healths:getAll', 240, function(){
    //         return $this->emp_health->select('emp_health_id', 'name')
    //                           ->with('subemp_health')
    //                           ->get();
    //     });
        
    //     return $emp_healths;

    // }




}