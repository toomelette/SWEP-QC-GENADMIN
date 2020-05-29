<?php

namespace App\Http\Requests\EmpHealthWeeklyPE;

use Illuminate\Foundation\Http\FormRequest;

class EmpHealthWeeklyPEFormRequest extends FormRequest{



    public function authorize(){
        return true;
    }

    

    public function rules(){

        return [

            'date' => 'required|date_format:"m/d/Y"',
            'blood_pressure'=>'nullable|string|max:90',
            'pulse_rate'=>'nullable|string|max:90',
            'temperature'=>'nullable|string|max:90',
            'condition'=>'nullable|string|max:90',
            'medication'=>'nullable|string|max:90',
            'recommendation'=>'nullable|string|max:255',

        ];

    }


}
