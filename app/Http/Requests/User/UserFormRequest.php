<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;


class UserFormRequest extends FormRequest{



    public function authorize(){

        return true;
        
    }


    
    public function rules(){

        $rules = [
            
            'firstname'=>'required|string|max:90',
            'middlename'=>'required|string|max:90',
            'lastname'=>'required|string|max:90',
            'email'=>'required|string|email|max:90',
            'position'=>'required|string|max:90',
            'dept_id'=>'nullable|string|max:11',
            'div_id'=>'nullable|string|max:11',
            'username'=>'required|string|max:45|unique:users,username,'.$this->route('user').',slug',
            'password'=>'sometimes|required|string|min:6|max:45|confirmed',

        ];

        if(!empty($this->request->get('menu'))){

            if(!empty($this->request->get('menu'))){
                foreach($this->request->get('menu') as $key => $value){
                    $rules['menu.'.$key] = 'string|max:11';
                } 
            }


            if(!empty($this->request->get('submenu'))){
                foreach($this->request->get('submenu') as $key => $value){
                    $rules['submenu.'.$key] = 'string|max:11';
                }
            }

        }

        return $rules;

    }





}
