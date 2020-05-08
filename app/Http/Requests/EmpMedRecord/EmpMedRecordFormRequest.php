<?php

namespace App\Http\Requests\EmpMedRecord;

use Illuminate\Foundation\Http\FormRequest;

class EmpMedRecordFormRequest extends FormRequest{



    public function authorize(){

        return true;
        
    }

   

    public function rules(){

        $rules = [];

        if(!empty($this->request->get('row_med_history'))){

            foreach($this->request->get('row_med_history') as $key => $value){
                
                $rules['row_med_history.'.$key.'.med_history_id'] = 'required|string|max:11';
                $rules['row_med_history.'.$key.'.status'] = 'required|string|max:5';
                $rules['row_med_history.'.$key.'.medication'] = 'nullable|string|max:255';
                $rules['row_med_history.'.$key.'.other_info'] = 'nullable|string|max:255';

            } 

        }

        return $rules;

    }



}
