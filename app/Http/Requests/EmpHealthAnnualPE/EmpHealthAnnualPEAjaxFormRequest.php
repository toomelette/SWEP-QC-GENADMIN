<?php

namespace App\Http\Requests\EmpHealthAnnualPE;

use Illuminate\Foundation\Http\FormRequest;

class EmpHealthAnnualPEAjaxFormRequest extends FormRequest{



    public function authorize(){
        return true;
    }

    

    public function rules(){

        return [

            'e_date' => 'required|date_format:"m/d/Y"',
            'e_pe'=>'nullable|string|max:90',
            'e_cbc'=>'nullable|string|max:90',
            'e_chem'=>'nullable|string|max:90',
            'e_urinalysis'=>'nullable|string|max:90',
            'e_xray'=>'nullable|string|max:90',
            'e_ecg'=>'nullable|string|max:90',
            'e_ultrasound'=>'nullable|string|max:90',
            'e_drug_test'=>'nullable|string|max:90',
            'e_company_cond'=>'nullable|string|max:90',

        ];

    }


}
