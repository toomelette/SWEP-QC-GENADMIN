<?php

namespace App\Http\Requests\JR;

use Illuminate\Foundation\Http\FormRequest;

class JRFilterRequest extends FormRequest{



    public function authorize(){

        return true;
    }

   


    public function rules(){

        return [

            'q' => 'nullable|string|max:90',
            'dept' => 'nullable|string|max:11',
            'div' => 'nullable|string|max:11',

        ];

    }




    
}
