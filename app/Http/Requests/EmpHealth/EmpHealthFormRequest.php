<?php

namespace App\Http\Requests\EmpHealth;

use Illuminate\Foundation\Http\FormRequest;

class EmpHealthFormRequest extends FormRequest{



    public function authorize(){
        return true;
    }

    

    public function rules(){

        $rows = $this->request->get('row');

        $rules = [

            'category'=>'required|string|max:11',
            'emp_no'=>'required|string|max:45|unique:emp_health,emp_no,'.$this->route('emp_health').',slug',
            'fullname'=>'required|string|max:255',
            'department_text'=>'required|string|max:90',
            'position'=>'required|string|max:90',
            'contact_no'=>'nullable|string|max:255',
            'address'=>'nullable|string|max:255',
            'birthday' => 'required|date_format:"m/d/Y"',
            'sex' => 'required|string|max:11',
            'civil_status' => 'required|string|max:11',
            'height' => 'nullable|string|max:45',
            'weight' => 'nullable|string|max:45',
            'philhealth_no' => 'nullable|string|max:45',
            'bloodtype' => 'nullable|string|max:11',
            'family_doctor' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',

            'travel_history' => 'nullable|string|max:255',
            'is_has_sick_history' => 'required|string|max:5',
            'is_has_sick_history_hos_visited' => 'nullable|string|max:255',
            'is_has_sick_history_condition' => 'nullable|string|max:255',
            'is_has_fever_history' => 'required|string|max:5',
            'is_has_fever_history_condition' => 'nullable|string|max:255',

            'is_smoking' => 'required|string|max:5',
            'is_smoking_packs_per_day' => 'nullable|string|max:45',
            'is_drinking_alcohol' => 'required|string|max:5',
            'is_drinking_alcohol_how_often' => 'nullable|string|max:255',
            'is_taking_drugs' => 'required|string|max:5',
            'is_taking_drugs_specific' => 'nullable|string|max:255',

            'is_taking_vitamins' => 'required|string|max:5',
            'is_taking_vitamins_specific' => 'nullable|string|max:255',
            'is_wearing_eyeglass' => 'required|string|max:5',
            'is_wearing_eyeglass_va' => 'nullable|string|max:255',
            'is_exercising' => 'required|string|max:5',
            'is_exercising_how_often' => 'nullable|string|max:255',

            'is_treating_medical_condition' => 'required|string|max:5',
            'is_treating_medical_condition_medicines' => 'nullable|string|max:255',
            'is_has_chronic_illness' => 'required|string|max:5',
            'is_has_chronic_illness_details' => 'nullable|string|max:255',

        ];

        if(!empty($rows)){
            foreach($rows as $key => $value){
                $rules['row.'.$key.'.mc_id'] = 'required|string|max:11';
                $rules['row.'.$key.'.is_checked'] = 'nullable|string|max:5';
                $rules['row.'.$key.'.medication'] = 'nullable|string|max:255';
            } 
        }

        return $rules;

    }


}
