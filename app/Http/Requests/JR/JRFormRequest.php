<?php

namespace App\Http\Requests\JR;

use Illuminate\Foundation\Http\FormRequest;

class JRFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        $rows = $this->request->get('row');

        $rules = [

            'jr_no' => 'required|string|max:45',
            'date' => 'nullable|date_format:"m/d/Y"',
            'purpose'=>'nullable|string|max:250',
            'req_by_name' => 'nullable|string|max:250',
            'req_by_designation' => 'nullable|string|max:250',
            'appr_by_name' => 'nullable|string|max:250',
            'appr_by_designation' => 'nullable|string|max:250',

        ];

        if(!empty($rows)){
            foreach($rows as $key => $value){
                $rules['row.'.$key.'.jp_stock_no'] = 'nullable|string|max:45';
                $rules['row.'.$key.'.jp_unit'] = 'nullable|string|max:45';
                $rules['row.'.$key.'.jp_item_name'] = 'nullable|string|max:255';
                $rules['row.'.$key.'.jp_item_description'] = 'nullable|string|max:255';
                $rules['row.'.$key.'.jp_qty'] = 'nullable|string|max:21';
                $rules['row.'.$key.'.jp_nature_of_work'] = 'nullable|string|max:255';
            } 
        }

        return $rules;

    }







}
