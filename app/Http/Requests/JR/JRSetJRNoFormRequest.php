<?php

namespace App\Http\Requests\JR;

use Illuminate\Foundation\Http\FormRequest;

class JRSetJRNoFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [

            'jr_no' => 'nullable|string|max:45',
            'date' => 'nullable|date_format:"m/d/Y"',

        ];

    }







}
