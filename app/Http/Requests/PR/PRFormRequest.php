<?php

namespace App\Http\Requests\PR;

use Illuminate\Foundation\Http\FormRequest;

class PRFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        $rows = $this->request->get('row');

        $rules = [

            'pr_no' => 'required|string|max:45',
            'pr_no_date' => 'nullable|date_format:"m/d/Y"',
            'sai_no' => 'nullable|string|max:45',
            'sai_no_date' => 'nullable|date_format:"m/d/Y"',
            'purpose'=>'nullable|string|max:250',
            'req_by_name' => 'nullable|string|max:250',
            'req_by_designation' => 'nullable|string|max:250',
            'appr_by_name' => 'nullable|string|max:250',
            'appr_by_designation' => 'nullable|string|max:250',

        ];

        if(!empty($rows)){
            foreach($rows as $key => $value){
                $rules['row.'.$key.'.pp_stock_no'] = 'nullable|string|max:45';
                $rules['row.'.$key.'.pp_unit'] = 'nullable|string|max:45';
                $rules['row.'.$key.'.pp_description'] = 'nullable|string|max:255';
                $rules['row.'.$key.'.pp_qty'] = 'nullable|string|max:21';
                $rules['row.'.$key.'.pp_unit_cost'] = 'nullable|string|max:21';
                $rules['row.'.$key.'.pp_total_cost'] = 'nullable|string|max:21';
            } 
        }

        return $rules;

    }







}
