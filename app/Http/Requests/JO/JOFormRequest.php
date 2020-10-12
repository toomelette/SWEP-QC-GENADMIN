<?php

namespace App\Http\Requests\JO;

use Illuminate\Foundation\Http\FormRequest;

class JOFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [

            'dept_id' => 'required|string|max:11',
            'div_id' => 'required|string|max:11',
            'to' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'tin' => 'nullable|string|max:90',
            'jo_no' => 'nullable|string|max:45',
            'date' => 'nullable|date_format:"m/d/Y"',
            'jr_id' => 'nullable|string|max:11',
            'place_of_delivery' => 'nullable|string|max:255',
            'date_of_delivery' => 'nullable|date_format:"m/d/Y"',
            'delivery_term' => 'nullable|string|max:255',
            'payment_term' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'scope_of_works' => 'nullable',
            'bur_no' => 'nullable|string|max:45',
            'amount' => 'nullable|string|max:21',

        ];

    }







}
