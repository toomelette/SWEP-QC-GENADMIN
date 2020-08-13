<?php

namespace App\Http\Requests\PR;

use Illuminate\Foundation\Http\FormRequest;

class PRFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [



        ];

    }







}
