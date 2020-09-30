<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\POParameterInterface;
use App\Models\POParameter;


class POParameterRepository extends BaseRepository implements POParameterInterface {
	

    protected $po_parameter;


	public function __construct(POParameter $po_parameter){

        $this->po_parameter = $po_parameter;
        parent::__construct();

    }




    public function store($data, $po){

        $po_parameter = new POParameter;
        $po_parameter->slug = $this->str->random(16);
        $po_parameter->po_id = $po->po_id;
        $po_parameter->po_param_id = $this->getPOParamIdInc();
        $po_parameter->stock_no = $data['pp_stock_no']; 
        $po_parameter->unit = $data['pp_unit']; 
        $po_parameter->item_name = nl2br($data['pp_item_name']); 
        $po_parameter->item_description = nl2br($data['pp_item_description']); 
        $po_parameter->qty = $this->__dataType->string_to_num($data['pp_qty']); 
        $po_parameter->unit_cost = $this->__dataType->string_to_num($data['pp_unit_cost']); 
        $po_parameter->total_cost = $this->__dataType->string_to_num($data['pp_total_cost']); 
        $po_parameter->save();
        
        return $po_parameter;

    }




    public function getPOParamIdInc(){

        $id = 'POP100001';
        $po_parameter = $this->po_parameter->select('po_param_id')
                                           ->orderBy('po_param_id', 'desc')
                                           ->first();

        if($po_parameter != null){
            $num = str_replace('POP', '', $po_parameter->po_param_id) + 1;
            $id = 'POP' . $num;
        }
        
        return $id;
        
    }




}