<?php

namespace App\Http\Requests\EmpHealth;

use Illuminate\Foundation\Http\FormRequest;

class EmpHealthFilterRequest extends FormRequest{



    public function authorize(){

        return true;
    }

   


    public function rules(){

        return [

            'q' => 'nullable|string|max:90',

        ];

    }




    
}
