<?php

namespace App\Http\Requests\Division;

use Illuminate\Foundation\Http\FormRequest;

class DivisionFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [

            'name'=>'required|string|max:255',
            'dept_id'=>'required|string|max:11',
            'acronym'=>'nullable|string|max:45',

        ];

    }





}
