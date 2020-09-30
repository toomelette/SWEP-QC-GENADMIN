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




    // public function fetch($request){

    //     $key = str_slug($request->fullUrl(), '_');
    //     $entries = isset($request->e) ? $request->e : 20;

    //     $po_list = $this->cache->remember('pr:fetch:' . $key, 240, function() use ($request, $entries){

    //         $po = $this->po->newQuery();
            
    //         if(isset($request->q)){
    //             $po->where('pr_no', 'LIKE', '%'. $request->q .'%')
    //                ->orWhere('sai_no', 'LIKE', '%'. $request->q .'%')
    //                ->orwhereHas('prParameter', function ($model) use ($request) {
    //                     $model->where('item_name', 'LIKE', '%'. $request->q .'%');
    //                });
    //         }

    //         return $po->select('po_id', 'dept_id', 'div_id', 'pr_no', 'created_at', 'slug')
    //                   ->with('department', 'division', 'prParameter')
    //                   ->sortable()
    //                   ->orderBy('updated_at', 'desc')
    //                   ->paginate($entries);

    //     });

    //     return $po_list;

    // }




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




    // public function update($request, $slug){

    //     $po = $this->findBySlug($slug);
    //     $po->pr_no = $request->pr_no;
    //     $po->pr_no_date = $this->__dataType->date_parse($request->pr_no_date);
    //     $po->sai_no = $request->sai_no;
    //     $po->sai_no_date = $this->__dataType->date_parse($request->sai_no_date);
    //     $po->purpose = nl2br($request->purpose);
    //     $po->req_by_name = $request->req_by_name;
    //     $po->req_by_designation = $request->req_by_designation;
    //     $po->appr_by_name = $request->appr_by_name;
    //     $po->appr_by_designation = $request->appr_by_designation;
    //     $po->updated_at = $this->carbon->now();
    //     $po->ip_updated = request()->ip();
    //     $po->user_updated = $this->auth->user()->user_id;
    //     $po->save();

    //     $po->prParameter()->delete();
        
    //     return $po;

    // }




    // public function destroy($slug){

    //     $po = $this->findBySlug($slug);
    //     $po->delete();

    //     $po->prParameter()->delete();

    //     return $po;

    // }




    // public function findBySlug($slug){

    //     $po = $this->cache->remember('pr:findBySlug:' . $slug, 240, function() use ($slug){
    //         return $this->po->where('slug', $slug)
    //                         ->with('prParameter', 'department', 'division')
    //                         ->first();
    //     }); 
        
    //     if(empty($po)){
    //         abort(404);
    //     }

    //     return $po;

    // }




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