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




    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $emp_health = $this->cache->remember('emp_health:fetch:' . $key, 240, function() use ($request, $entries){

            $emp_health = $this->emp_health->newQuery();
            
            if(isset($request->q)){
                $emp_health->where('fullname', 'LIKE', '%'. $request->q .'%')
                           ->orWhere('emp_no', 'LIKE', '%'. $request->q .'%')
                           ->orWhere('department_text', 'LIKE', '%'. $request->q .'%')
                           ->orWhere('position', 'LIKE', '%'. $request->q .'%')
                           ->orWhere('contact_no', 'LIKE', '%'. $request->q .'%')
                           ->orWhere('address', 'LIKE', '%'. $request->q .'%');
            }

            return $emp_health->select('emp_health_id', 'emp_no', 'fullname', 'position', 'department_text', 'slug')
                              ->with('empHealthMedHistory')
                              ->sortable()
                              ->orderBy('updated_at', 'desc')
                              ->paginate($entries);

        });

        return $emp_health;

    }




    public function store($request){

        $emp_health = new EmpHealth;
        $emp_health->slug = $this->str->random(16);
        $emp_health->emp_health_id = $this->getEmpHealthIdInc();

        $emp_health->emp_no = $request->emp_no;
        $emp_health->fullname = $request->fullname;
        $emp_health->department_text = $request->department_text;
        $emp_health->position = $request->position;
        $emp_health->contact_no = $request->contact_no;
        $emp_health->address = $request->address;
        $emp_health->birthday = $this->__dataType->date_parse($request->birthday);
        $emp_health->sex = $request->sex;
        $emp_health->civil_status = $request->civil_status;
        $emp_health->height = $request->height;
        $emp_health->weight = $request->weight;
        $emp_health->philhealth_no = $request->philhealth_no;
        $emp_health->bloodtype = $request->bloodtype;
        $emp_health->family_doctor = $request->family_doctor;
        $emp_health->contact_person = $request->contact_person;

        $emp_health->travel_history = $request->travel_history;
        $emp_health->is_has_sick_history = $this->__dataType->string_to_boolean($request->is_has_sick_history);
        $emp_health->is_has_sick_history_hos_visited = $request->is_has_sick_history_hos_visited;
        $emp_health->is_has_sick_history_condition = $request->is_has_sick_history_condition;
        $emp_health->is_has_fever_history = $this->__dataType->string_to_boolean($request->is_has_fever_history);
        $emp_health->is_has_fever_history_condition = $request->is_has_fever_history_condition;

        $emp_health->is_smoking = $this->__dataType->string_to_boolean($request->is_smoking);
        $emp_health->is_smoking_packs_per_day = $request->is_smoking_packs_per_day;
        $emp_health->is_drinking_alcohol = $this->__dataType->string_to_boolean($request->is_drinking_alcohol);
        $emp_health->is_drinking_alcohol_how_often = $request->is_drinking_alcohol_how_often;
        $emp_health->is_taking_drugs = $this->__dataType->string_to_boolean($request->is_taking_drugs);
        $emp_health->is_taking_drugs_specific = $request->is_taking_drugs_specific;

        $emp_health->is_taking_vitamins = $this->__dataType->string_to_boolean($request->is_taking_vitamins);
        $emp_health->is_taking_vitamins_specific = $request->is_taking_vitamins_specific;
        $emp_health->is_wearing_eyeglass = $this->__dataType->string_to_boolean($request->is_wearing_eyeglass);
        $emp_health->is_wearing_eyeglass_va = $request->is_wearing_eyeglass_va;
        $emp_health->is_exercising = $this->__dataType->string_to_boolean($request->is_exercising);
        $emp_health->is_exercising_how_often = $request->is_exercising_how_often;

        $emp_health->is_treating_medical_condition = $this->__dataType->string_to_boolean($request->is_treating_medical_condition);
        $emp_health->is_treating_medical_condition_medicines = $request->is_treating_medical_condition_medicines;
        $emp_health->is_has_chronic_illness = $this->__dataType->string_to_boolean($request->is_has_chronic_illness);
        $emp_health->is_has_chronic_illness_details = $request->is_has_chronic_illness_details;

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




    public function findBySlug($slug){

        $emp_health = $this->cache->remember('emp_health:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->emp_health->where('slug', $slug)->first();
        }); 
        
        if(empty($emp_health)){
            abort(404);
        }

        return $emp_health;

    }




    // public function findByEmpHealthId($emp_health_id){

    //     $emp_health = $this->cache->remember('emp_health:findByEmpHealthId:' . $emp_health_id, 240, function() use ($emp_health_id){
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

    //     $emp_health = $this->cache->remember('emp_health:getAll', 240, function(){
    //         return $this->emp_health->select('emp_health_id', 'name')
    //                           ->with('subemp_health')
    //                           ->get();
    //     });
        
    //     return $emp_health;

    // }




}