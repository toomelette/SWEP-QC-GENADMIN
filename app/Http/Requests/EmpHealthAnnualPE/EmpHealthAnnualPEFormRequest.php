<?php

namespace App\Http\Requests\EmpHealthAnnualPE;

use Illuminate\Foundation\Http\FormRequest;

class EmpHealthAnnualPEFormRequest extends FormRequest{



    public function authorize(){
        return true;
    }

    

    public function rules(){

        return [

            'date' => 'required|date_format:"m/d/Y"',
            'pe'=>'nullable|string|max:90',
            'cbc'=>'nullable|string|max:90',
            'chem'=>'nullable|string|max:90',
            'urinalysis'=>'nullable|string|max:90',
            'xray'=>'nullable|string|max:90',
            'ecg'=>'nullable|string|max:90',
            'ultrasound'=>'nullable|string|max:90',
            'drug_test'=>'nullable|string|max:90',
            'company_cond'=>'nullable|string|max:90',

        ];

    }



}
