<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\JRParameterInterface;
use App\Models\JRParameter;


class JRParameterRepository extends BaseRepository implements JRParameterInterface {
	

    protected $jr_parameter;


	public function __construct(JRParameter $jr_parameter){

        $this->jr_parameter = $jr_parameter;
        parent::__construct();

    }




    public function store($data, $jr){

        $jr_parameter = new JRParameter;
        $jr_parameter->slug = $this->str->random(16);
        $jr_parameter->jr_id = $jr->jr_id;
        $jr_parameter->jr_param_id = $this->getJRParamIdInc();
        $jr_parameter->stock_no = $data['jp_stock_no']; 
        $jr_parameter->unit = $data['jp_unit']; 
        $jr_parameter->item_name = nl2br($data['jp_item_name']); 
        $jr_parameter->item_description = nl2br($data['jp_item_description']); 
        $jr_parameter->qty = $this->__dataType->string_to_num($data['jp_qty']); 
        $jr_parameter->nature_of_work = nl2br($data['jp_nature_of_work']); 
        $jr_parameter->save();
        
        return $jr_parameter;

    }




    public function getJRParamIdInc(){

        $id = 'JRP100001';
        $jr_parameter = $this->jr_parameter->select('jr_param_id')
                                           ->orderBy('jr_param_id', 'desc')
                                           ->first();

        if($jr_parameter != null){
            $num = str_replace('JRP', '', $jr_parameter->jr_param_id) + 1;
            $id = 'JRP' . $num;
        }
        
        return $id;
        
    }




}