<?php

namespace App\Http\Requests\EmpMedRecord;

use Illuminate\Foundation\Http\FormRequest;

class EmpMedRecordFilterRequest extends FormRequest{



    public function authorize(){

        return true;
        
    }

   

    public function rules(){

        return [

            'q' => 'nullable|string|max:90',

        ];

    }



}
