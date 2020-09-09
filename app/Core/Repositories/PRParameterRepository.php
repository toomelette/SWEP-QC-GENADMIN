<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\PRParameterInterface;
use App\Models\PRParameter;


class PRParameterRepository extends BaseRepository implements PRParameterInterface {
	

    protected $pr_parameter;


	public function __construct(PRParameter $pr_parameter){

        $this->pr_parameter = $pr_parameter;
        parent::__construct();

    }




    public function store($data, $pr){

        $pr_parameter = new PRParameter;
        $pr_parameter->slug = $this->str->random(16);
        $pr_parameter->pr_id = $pr->pr_id;
        $pr_parameter->pr_param_id = $this->getPRParamIdInc();
        $pr_parameter->stock_no = $data['pp_stock_no']; 
        $pr_parameter->unit = $data['pp_unit']; 
        $pr_parameter->description = nl2br($data['pp_description']); 
        $pr_parameter->qty = $this->__dataType->string_to_num($data['pp_qty']); 
        $pr_parameter->unit_cost = $this->__dataType->string_to_num($data['pp_unit_cost']); 
        $pr_parameter->total_cost = $this->__dataType->string_to_num($data['pp_total_cost']); 
        $pr_parameter->save();
        
        return $pr_parameter;

    }




    public function getPRParamIdInc(){

        $id = 'PRP100001';
        $pr_parameter = $this->pr_parameter->select('pr_param_id')
                                           ->orderBy('pr_param_id', 'desc')
                                           ->first();

        if($pr_parameter != null){
            $num = str_replace('PRP', '', $pr_parameter->pr_param_id) + 1;
            $id = 'PRP' . $num;
        }
        
        return $id;
        
    }




}