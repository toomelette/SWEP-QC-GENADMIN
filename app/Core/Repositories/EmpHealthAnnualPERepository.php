<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\EmpHealthAnnualPEInterface;

use App\Models\EmpHealthAnnualPE;


class EmpHealthAnnualPERepository extends BaseRepository implements EmpHealthAnnualPEInterface {
    


    protected $emp_health_annual_pe;



    public function __construct(EmpHealthAnnualPE $emp_health_annual_pe){

        $this->emp_health_annual_pe = $emp_health_annual_pe;
        parent::__construct();

    }




    public function fetchByEmpHealthId($emp_health_id, $request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $emp_health_annual_pe_list = $this->cache->remember('emp_health_annual_pe:fetchByEmpHealthId:'. $emp_health_id .':' . $key, 240, function() use ($emp_health_id, $entries){

            $emp_health_annual_pe = $this->emp_health_annual_pe->newQuery();

            return $emp_health_annual_pe->select('date', 'pe', 'cbc', 'chem', 'urinalysis', 'xray', 'ecg', 'ultrasound', 'drug_test', 'company_cond', 'slug')
                                        ->sortable()
                                        ->where('emp_health_id', $emp_health_id)
                                        ->orderBy('date', 'asc')
                                        ->paginate($entries);

        });

        return $emp_health_annual_pe_list;

    }




    public function store($request){

        $emp_health_annual_pe = new EmpHealthAnnualPE;
        $emp_health_annual_pe->slug = $this->str->random(16);
        $emp_health_annual_pe->emp_health_id = $request->emp_health_id;
        $emp_health_annual_pe->date = $this->__dataType->date_parse($request->date);
        $emp_health_annual_pe->pe = $request->pe;
        $emp_health_annual_pe->cbc = $request->cbc;
        $emp_health_annual_pe->chem = $request->chem;
        $emp_health_annual_pe->urinalysis = $request->urinalysis;
        $emp_health_annual_pe->xray = $request->xray;
        $emp_health_annual_pe->ecg = $request->ecg;
        $emp_health_annual_pe->ultrasound = $request->ultrasound;
        $emp_health_annual_pe->drug_test = $request->drug_test;
        $emp_health_annual_pe->company_cond = $request->company_cond;
        $emp_health_annual_pe->created_at = $this->carbon->now();
        $emp_health_annual_pe->updated_at = $this->carbon->now();
        $emp_health_annual_pe->ip_created = request()->ip();
        $emp_health_annual_pe->ip_updated = request()->ip();
        $emp_health_annual_pe->user_created = $this->auth->user()->user_id;
        $emp_health_annual_pe->user_updated = $this->auth->user()->user_id;
        $emp_health_annual_pe->save();
        
        return $emp_health_annual_pe;

    }




    public function update($request, $slug){

        $emp_health_annual_pe = $this->findBySlug($slug);
        $emp_health_annual_pe->date = $this->__dataType->date_parse($request->e_date);
        $emp_health_annual_pe->pe = $request->e_pe;
        $emp_health_annual_pe->cbc = $request->e_cbc;
        $emp_health_annual_pe->chem = $request->e_chem;
        $emp_health_annual_pe->urinalysis = $request->e_urinalysis;
        $emp_health_annual_pe->xray = $request->e_xray;
        $emp_health_annual_pe->ecg = $request->e_ecg;
        $emp_health_annual_pe->ultrasound = $request->e_ultrasound;
        $emp_health_annual_pe->drug_test = $request->e_drug_test;
        $emp_health_annual_pe->company_cond = $request->e_company_cond;
        $emp_health_annual_pe->updated_at = $this->carbon->now();
        $emp_health_annual_pe->ip_updated = request()->ip();
        $emp_health_annual_pe->user_updated = $this->auth->user()->user_id;
        $emp_health_annual_pe->save();
        
        return $emp_health_annual_pe;

    }




    public function destroy($slug){

        $emp_health_annual_pe = $this->findBySlug($slug);
        $emp_health_annual_pe->delete();

        return $emp_health_annual_pe;

    }




    public function findBySlug($slug){

        $emp_health_annual_pe = $this->cache->remember('emp_health_annual_pe:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->emp_health_annual_pe->where('slug', $slug)->first();
        }); 
        
        if(empty($emp_health_annual_pe)){
            abort(404);
        }

        return $emp_health_annual_pe;

    }




    public function getBySlug($slug){

        $emp_health_annual_pe = $this->cache->remember('emp_health_annual_pe:getBySlug:' . $slug, 240, 
            function() use ($slug){
                return $this->emp_health_annual_pe->where('slug', $slug)->get();
        }); 

        return $emp_health_annual_pe;

    }




}