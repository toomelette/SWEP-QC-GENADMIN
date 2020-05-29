<?php

namespace App\Http\Requests\EmpHealthWeeklyPE;

use Illuminate\Foundation\Http\FormRequest;

class EmpHealthWeeklyPEAjaxFormRequest extends FormRequest{



    public function authorize(){
        return true;
    }

    

    public function rules(){

        return [

            'e_date' => 'required|date_format:"m/d/Y"',
            'e_blood_pressure'=>'nullable|string|max:90',
            'e_pulse_rate'=>'nullable|string|max:90',
            'e_temperature'=>'nullable|string|max:90',
            'e_condition'=>'nullable|string|max:90',
            'e_medication'=>'nullable|string|max:90',
            'e_recommendation'=>'nullable|string|max:255',

        ];

    }


}
