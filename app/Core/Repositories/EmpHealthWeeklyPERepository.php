<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\EmpHealthWeeklyPEInterface;

use App\Models\EmpHealthWeeklyPE;


class EmpHealthWeeklyPERepository extends BaseRepository implements EmpHealthWeeklyPEInterface {
    

    protected $emp_health_weekly_pe;


    public function __construct(EmpHealthWeeklyPE $emp_health_weekly_pe){

        $this->emp_health_weekly_pe = $emp_health_weekly_pe;
        parent::__construct();

    }




    public function fetchByEmpHealthId($emp_health_id, $request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $emp_health_weekly_pe_list = $this->cache->remember('emp_health_weekly_pe:fetchByEmpHealthId:'. $emp_health_id .':' . $key, 240, function() use ($emp_health_id, $entries){

            $emp_health_weekly_pe = $this->emp_health_weekly_pe->newQuery();

            return $emp_health_weekly_pe->select('date', 'blood_pressure', 'pulse_rate', 'temperature', 'condition', 'medication', 'recommendation', 'slug')
                                        ->sortable()
                                        ->where('emp_health_id', $emp_health_id)
                                        ->orderBy('date', 'asc')
                                        ->paginate($entries);

        });

        return $emp_health_weekly_pe_list;

    }




    public function store($request){

        $emp_health_weekly_pe = new EmpHealthWeeklyPE;
        $emp_health_weekly_pe->slug = $this->str->random(16);
        $emp_health_weekly_pe->emp_health_id = $request->emp_health_id;
        $emp_health_weekly_pe->date = $this->__dataType->date_parse($request->date);
        $emp_health_weekly_pe->blood_pressure = $request->blood_pressure;
        $emp_health_weekly_pe->pulse_rate = $request->pulse_rate;
        $emp_health_weekly_pe->temperature = $request->temperature;
        $emp_health_weekly_pe->condition = $request->condition;
        $emp_health_weekly_pe->medication = $request->medication;
        $emp_health_weekly_pe->recommendation = $request->recommendation;
        $emp_health_weekly_pe->created_at = $this->carbon->now();
        $emp_health_weekly_pe->updated_at = $this->carbon->now();
        $emp_health_weekly_pe->ip_created = request()->ip();
        $emp_health_weekly_pe->ip_updated = request()->ip();
        $emp_health_weekly_pe->user_created = $this->auth->user()->user_id;
        $emp_health_weekly_pe->user_updated = $this->auth->user()->user_id;
        $emp_health_weekly_pe->save();
        
        return $emp_health_weekly_pe;

    }




    public function update($request, $slug){

        $emp_health_weekly_pe = $this->findBySlug($slug);
        $emp_health_weekly_pe->date = $this->__dataType->date_parse($request->e_date);
        $emp_health_weekly_pe->blood_pressure = $request->e_blood_pressure;
        $emp_health_weekly_pe->pulse_rate = $request->e_pulse_rate;
        $emp_health_weekly_pe->temperature = $request->e_temperature;
        $emp_health_weekly_pe->condition = $request->e_condition;
        $emp_health_weekly_pe->medication = $request->e_medication;
        $emp_health_weekly_pe->recommendation = $request->e_recommendation;
        $emp_health_weekly_pe->updated_at = $this->carbon->now();
        $emp_health_weekly_pe->ip_updated = request()->ip();
        $emp_health_weekly_pe->user_updated = $this->auth->user()->user_id;
        $emp_health_weekly_pe->save();
        
        return $emp_health_weekly_pe;

    }




    public function destroy($slug){

        $emp_health_weekly_pe = $this->findBySlug($slug);
        $emp_health_weekly_pe->delete();

        return $emp_health_weekly_pe;

    }




    public function findBySlug($slug){

        $emp_health_weekly_pe = $this->cache->remember('emp_health_weekly_pe:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->emp_health_weekly_pe->where('slug', $slug)->first();
        }); 
        
        if(empty($emp_health_weekly_pe)){
            abort(404);
        }

        return $emp_health_weekly_pe;

    }




    public function getBySlug($slug){

        $emp_health_weekly_pe = $this->cache->remember('emp_health_weekly_pe:getBySlug:' . $slug, 240, function() use ($slug){
            return $this->emp_health_weekly_pe->where('slug', $slug)->get();
        }); 

        return $emp_health_weekly_pe;

    }




}