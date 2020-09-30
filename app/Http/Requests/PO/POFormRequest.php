<?php

namespace App\Http\Requests\PO;

use Illuminate\Foundation\Http\FormRequest;

class POFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        $rows = $this->request->get('row');

        $rules = [

            'dept_id' => 'required|string|max:11',
            'div_id' => 'required|string|max:11',
            'to' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'tin' => 'nullable|string|max:90',
            'po_no' => 'nullable|string|max:45',
            'date' => 'nullable|date_format:"m/d/Y"',
            'mode_of_procurement' => 'nullable|string|max:90',
            'place_of_delivery' => 'nullable|string|max:255',
            'date_of_delivery' => 'nullable|date_format:"m/d/Y"',
            'delivery_term' => 'nullable|string|max:255',
            'payment_term' => 'nullable|string|max:255',
            'name_of_supplier' => 'nullable|string|max:255',
            'bur_no' => 'nullable|string|max:45',
            'amount' => 'nullable|string|max:21',

        ];

        if(!empty($rows)){
            foreach($rows as $key => $value){
                $rules['row.'.$key.'.pp_stock_no'] = 'nullable|string|max:45';
                $rules['row.'.$key.'.pp_unit'] = 'nullable|string|max:45';
                $rules['row.'.$key.'.pp_item_name'] = 'nullable|string|max:255';
                $rules['row.'.$key.'.pp_item_description'] = 'nullable|string|max:255';
                $rules['row.'.$key.'.pp_qty'] = 'nullable|string|max:21';
                $rules['row.'.$key.'.pp_unit_cost'] = 'nullable|string|max:21';
                $rules['row.'.$key.'.pp_total_cost'] = 'nullable|string|max:21';
            } 
        }

        return $rules;

    }







}
