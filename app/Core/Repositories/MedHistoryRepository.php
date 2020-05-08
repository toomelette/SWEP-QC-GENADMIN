<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\MedHistoryInterface;

use App\Models\MedHistory;


class MedHistoryRepository extends BaseRepository implements MedHistoryInterface {
	

    protected $med_history;


	public function __construct(MedHistory $med_history){

        $this->med_history = $med_history;
        parent::__construct();

    }




    public function getAll(){

        $med_history = $this->cache->remember('med_history:getAll', 240, function(){
            return $this->med_history->select('med_history_id', 'seq_no', 'name')->get();
        });
        
        return $med_history;

    }




    public function findByMedHistoryId($med_history_id){

        $med_history = $this->cache->remember('med_history:findByMedHistoryId:' . $med_history_id, 240, function() use ($med_history_id){
            return $this->med_history->where('med_history_id', $med_history_id)->first();
        });
        
        if(empty($med_history)){
            abort(404);
        }
        
        return $med_history;

    }




}