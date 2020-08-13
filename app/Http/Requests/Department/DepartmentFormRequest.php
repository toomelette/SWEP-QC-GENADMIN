<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [

            'name'=>'required|string|max:255',
            'acronym'=>'nullable|string|max:45',

        ];

    }





}
