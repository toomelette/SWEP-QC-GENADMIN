<?php

namespace App\Http\Requests\PO;

use Illuminate\Foundation\Http\FormRequest;

class POFilterRequest extends FormRequest{



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
