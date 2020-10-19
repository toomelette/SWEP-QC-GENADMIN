<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\POInterface;

use App\Models\PO;


class PORepository extends BaseRepository implements POInterface {
	

    protected $po;


	public function __construct(PO $po){

        $this->po = $po;
        parent::__construct();

    }




    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $po_list = $this->cache->remember('po:fetch:' . $key, 240, function() use ($request, $entries){

            $po = $this->po->newQuery();

            if (isset($request->dept)) {
                $po->where('dept_id', $request->dept);
            }

            if (isset($request->div)) {
                $po->where('div_id', $request->div);
            }
            
            if(isset($request->q)){
                $po->where('po_no', 'LIKE', '%'. $request->q .'%')
                   ->orwhereHas('poParameter', function ($model) use ($request) {
                        $model->where('item_name', 'LIKE', '%'. $request->q .'%');
                   });
            }

            return $po->select('po_id', 'dept_id', 'div_id', 'po_no', 'date', 'created_at', 'slug')
                      ->with('department', 'division', 'poParameter')
                      ->sortable()
                      ->orderBy('updated_at', 'desc')
                      ->paginate($entries);

        });

        return $po_list;

    }




    public function fetchByDeptId($dept_id, $request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $po_list = $this->cache->remember('po:fetchByDeptId:'.$dept_id.':' . $key, 240, function() use ($dept_id, $request, $entries){

            $po = $this->po->newQuery();
            
            if(isset($request->q)){
                $po->where('po_no', 'LIKE', '%'. $request->q .'%')
                   ->orwhereHas('poParameter', function ($model) use ($request) {
                        $model->where('item_name', 'LIKE', '%'. $request->q .'%');
                   });
            }

            return $po->select('po_id', 'dept_id', 'div_id', 'po_no', 'created_at', 'slug')
                      ->where('dept_id', $dept_id)
                      ->with('division', 'poParameter')
                      ->sortable()
                      ->orderBy('updated_at', 'desc')
                      ->paginate($entries);

        });

        return $po_list;

    }




    public function store($request){

        $po = new PO;
        $po->slug = $this->str->random(16);
        $po->po_id = $this->getPOIdInc();
        $po->dept_id = $request->dept_id;
        $po->div_id = $request->div_id;
        $po->to = $request->to;
        $po->address = $request->address;
        $po->tin = $request->tin;
        $po->po_no = $request->po_no;
        $po->date = $this->__dataType->date_parse($request->date);
        $po->mode_of_procurement = $request->mode_of_procurement;
        $po->place_of_delivery = $request->place_of_delivery;
        $po->date_of_delivery = $this->__dataType->date_parse($request->date_of_delivery);
        $po->delivery_term = $request->delivery_term;
        $po->payment_term = $request->payment_term;
        $po->name_of_supplier = $request->name_of_supplier;
        $po->bur_no = $request->bur_no;
        $po->amount = $this->__dataType->string_to_num($request->amount);
        $po->created_at = $this->carbon->now();
        $po->updated_at = $this->carbon->now();
        $po->ip_created = request()->ip();
        $po->ip_updated = request()->ip();
        $po->user_created = $this->auth->user()->user_id;
        $po->user_updated = $this->auth->user()->user_id;
        $po->save();
        
        return $po;

    }




    public function update($request, $slug){

        $po = $this->findBySlug($slug);
        $po->dept_id = $request->dept_id;
        $po->div_id = $request->div_id;
        $po->to = $request->to;
        $po->address = $request->address;
        $po->tin = $request->tin;

        if($request->has('po_no')){
            $po->po_no = $request->po_no;
        }
        if($request->has('date')){
            $po->date = $this->__dataType->date_parse($request->date);
        }

        $po->mode_of_procurement = $request->mode_of_procurement;
        $po->place_of_delivery = $request->place_of_delivery;
        $po->date_of_delivery = $this->__dataType->date_parse($request->date_of_delivery);
        $po->delivery_term = $request->delivery_term;
        $po->payment_term = $request->payment_term;
        $po->name_of_supplier = $request->name_of_supplier;
        $po->bur_no = $request->bur_no;
        $po->amount = $this->__dataType->string_to_num($request->amount);
        $po->updated_at = $this->carbon->now();
        $po->ip_updated = request()->ip();
        $po->user_updated = $this->auth->user()->user_id;
        $po->save();

        $po->poParameter()->delete();
        
        return $po;

    }




    public function updatePONo($request, $slug){

        $po = $this->findBySlug($slug);
        $po->po_no = $request->po_no;
        $po->date = $this->__dataType->date_parse($request->date);
        $po->updated_at = $this->carbon->now();
        $po->ip_updated = request()->ip();
        $po->user_updated = $this->auth->user()->user_id;
        $po->save();
        
        return $po;

    }




    public function destroy($slug){

        $po = $this->findBySlug($slug);
        $po->delete();

        $po->poParameter()->delete();

        return $po;

    }




    public function findBySlug($slug){

        $po = $this->cache->remember('po:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->po->where('slug', $slug)
                            ->with('poParameter', 'department', 'division')
                            ->first();
        }); 
        
        if(empty($po)){
            abort(404);
        }

        return $po;

    }




    public function getPOIdInc(){

        $id = 'PO1001';
        $po = $this->po->select('po_id')->orderBy('po_id', 'desc')->first();

        if($po != null){
            if($po->po_id != null){
                $num = str_replace('PO', '', $po->po_id) + 1;
                $id = 'PO' . $num;
            }
        }
        
        return $id;
        
    }




}