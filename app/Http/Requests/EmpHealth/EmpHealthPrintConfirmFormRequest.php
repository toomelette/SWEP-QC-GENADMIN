<?php

namespace App\Http\Requests\EmpHealth;

use Illuminate\Foundation\Http\FormRequest;

class EmpHealthPrintConfirmFormRequest extends FormRequest{



    public function authorize(){
    	
    	return true;
    
    }

    

    public function rules(){
        
        return

            [

                'password'=>'required|string|max:90',

            ];

    }



}
