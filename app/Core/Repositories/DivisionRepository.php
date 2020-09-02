<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\DivisionInterface;

use App\Models\Division;


class DivisionRepository extends BaseRepository implements DivisionInterface {
	

    protected $division;


	public function __construct(Division $division){

        $this->division = $division;
        parent::__construct();

    }




    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $divisions = $this->cache->remember('divisions:fetch:' . $key, 240, function() use ($request, $entries){

            $division = $this->division->newQuery();
            
            if(isset($request->q)){
                $division->where('name', 'LIKE', '%'. $request->q .'%')
                         ->orWhere('acronym', 'LIKE', '%'. $request->q .'%');
            }

            return $division->select('dept_id', 'name', 'slug')
                            ->with('department')
                            ->sortable()
                            ->orderBy('updated_at', 'desc')
                            ->paginate($entries);

        });

        return $divisions;

    }




    public function store($request){

        $division = new Division;
        $division->div_id = $this->getDivIdInc();
        $division->slug = $this->str->random(16);
        $division->dept_id = $request->dept_id;
        $division->name = $request->name;
        $division->acronym = $request->acronym;
        $division->created_at = $this->carbon->now();
        $division->updated_at = $this->carbon->now();
        $division->ip_created = request()->ip();
        $division->ip_updated = request()->ip();
        $division->user_created = $this->auth->user()->user_id;
        $division->user_updated = $this->auth->user()->user_id;
        $division->save();
        
        return $division;

    }




    public function update($request, $slug){

        $division = $this->findBySlug($slug);
        $division->name = $request->name;
        $division->dept_id = $request->dept_id;
        $division->acronym = $request->acronym;
        $division->updated_at = $this->carbon->now();
        $division->ip_updated = request()->ip();
        $division->user_updated = $this->auth->user()->user_id;
        $division->save();
        
        return $division;

    }




    public function destroy($slug){

        $division = $this->findBySlug($slug);
        $division->delete();

        return $division;

    }




    public function findBySlug($slug){

        $division = $this->cache->remember('divisions:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->division->where('slug', $slug)->first();
        }); 
        
        if(empty($division)){
            abort(404);
        }

        return $division;

    }




    public function getDivIdInc(){

        $id = 'D1001';
        $division = $this->division->select('div_id')->orderBy('div_id', 'desc')->first();

        if($division != null){
            if($division->div_id != null){
                $num = str_replace('D', '', $division->div_id) + 1;
                $id = 'D' . $num;
            }
        }
        
        return $id;
        
    }




    public function getAll(){

        $divisions = $this->cache->remember('divisions:getAll', 240, function(){
            return $this->division->select('div_id', 'name')->get();
        });
        
        return $divisions;

    }




}