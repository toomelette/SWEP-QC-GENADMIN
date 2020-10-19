<?php

namespace App\Http\Requests\JO;

use Illuminate\Foundation\Http\FormRequest;

class JOSetJONoFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [

            'jo_no' => 'nullable|string|max:45',
            'date' => 'nullable|date_format:"m/d/Y"',
            'jr_id' => 'nullable|string|max:11',

        ];

    }







}
