<?php

namespace App\Http\Requests\PR;

use Illuminate\Foundation\Http\FormRequest;

class PRSetPRNoFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [

            'pr_no' => 'nullable|string|max:45',
            'pr_no_date' => 'nullable|date_format:"m/d/Y"',
            'sai_no' => 'nullable|string|max:45',
            'sai_no_date' => 'nullable|date_format:"m/d/Y"',

        ];

    }






}
