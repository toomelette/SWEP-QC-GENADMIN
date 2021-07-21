<?php

namespace App\Http\Requests\PR;

use Illuminate\Foundation\Http\FormRequest;

class PRReportsRequest extends FormRequest{


    public function authorize(){
        return true;
    }


    public function rules(){
        return [

            'df' => 'required|date_format:"m/d/Y"',
            'dt' => 'required|date_format:"m/d/Y"',

        ];
    }


}
