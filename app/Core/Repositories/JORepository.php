<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\JOInterface;

use App\Models\JO;


class JORepository extends BaseRepository implements JOInterface {
	

    protected $jo;


	public function __construct(JO $jo){

        $this->jo = $jo;
        parent::__construct();

    }




    // public function fetch($request){

    //     $key = str_slug($request->fullUrl(), '_');
    //     $entries = isset($request->e) ? $request->e : 20;

    //     $jo_list = $this->cache->remember('jo:fetch:' . $key, 240, function() use ($request, $entries){

    //         $jo = $this->jo->newQuery();
            
    //         if(isset($request->q)){
    //             $jo->where('po_no', 'LIKE', '%'. $request->q .'%')
    //                ->orwhereHas('poParameter', function ($model) use ($request) {
    //                     $model->where('item_name', 'LIKE', '%'. $request->q .'%');
    //                });
    //         }

    //         return $jo->select('po_id', 'dept_id', 'div_id', 'po_no', 'created_at', 'slug')
    //                   ->with('department', 'division', 'poParameter')
    //                   ->sortable()
    //                   ->orderBy('updated_at', 'desc')
    //                   ->paginate($entries);

    //     });

    //     return $jo_list;

    // }




    // public function store($request){

    //     $jo = new JO;
    //     $jo->slug = $this->str->random(16);
    //     $jo->po_id = $this->getJOIdInc();
    //     $jo->dept_id = $request->dept_id;
    //     $jo->div_id = $request->div_id;
    //     $jo->to = $request->to;
    //     $jo->address = $request->address;
    //     $jo->tin = $request->tin;
    //     $jo->po_no = $request->po_no;
    //     $jo->date = $this->__dataType->date_parse($request->date);
    //     $jo->mode_of_procurement = $request->mode_of_procurement;
    //     $jo->place_of_delivery = $request->place_of_delivery;
    //     $jo->date_of_delivery = $this->__dataType->date_parse($request->date_of_delivery);
    //     $jo->delivery_term = $request->delivery_term;
    //     $jo->payment_term = $request->payment_term;
    //     $jo->name_of_supplier = $request->name_of_supplier;
    //     $jo->bur_no = $request->bur_no;
    //     $jo->amount = $this->__dataType->string_to_num($request->amount);
    //     $jo->created_at = $this->carbon->now();
    //     $jo->updated_at = $this->carbon->now();
    //     $jo->ip_created = request()->ip();
    //     $jo->ip_updated = request()->ip();
    //     $jo->user_created = $this->auth->user()->user_id;
    //     $jo->user_updated = $this->auth->user()->user_id;
    //     $jo->save();
        
    //     return $jo;

    // }




    // public function update($request, $slug){

    //     $jo = $this->findBySlug($slug);
    //     $jo->dept_id = $request->dept_id;
    //     $jo->div_id = $request->div_id;
    //     $jo->to = $request->to;
    //     $jo->address = $request->address;
    //     $jo->tin = $request->tin;
    //     $jo->po_no = $request->po_no;
    //     $jo->date = $this->__dataType->date_parse($request->date);
    //     $jo->mode_of_procurement = $request->mode_of_procurement;
    //     $jo->place_of_delivery = $request->place_of_delivery;
    //     $jo->date_of_delivery = $this->__dataType->date_parse($request->date_of_delivery);
    //     $jo->delivery_term = $request->delivery_term;
    //     $jo->payment_term = $request->payment_term;
    //     $jo->name_of_supplier = $request->name_of_supplier;
    //     $jo->bur_no = $request->bur_no;
    //     $jo->amount = $this->__dataType->string_to_num($request->amount);
    //     $jo->updated_at = $this->carbon->now();
    //     $jo->ip_updated = request()->ip();
    //     $jo->user_updated = $this->auth->user()->user_id;
    //     $jo->save();

    //     $jo->poParameter()->delete();
        
    //     return $jo;

    // }




    // public function destroy($slug){

    //     $jo = $this->findBySlug($slug);
    //     $jo->delete();

    //     $jo->poParameter()->delete();

    //     return $jo;

    // }




    // public function findBySlug($slug){

    //     $jo = $this->cache->remember('jo:findBySlug:' . $slug, 240, function() use ($slug){
    //         return $this->jo->where('slug', $slug)
    //                         ->with('poParameter', 'department', 'division')
    //                         ->first();
    //     }); 
        
    //     if(empty($jo)){
    //         abort(404);
    //     }

    //     return $jo;

    // }




    // public function getJOIdInc(){

    //     $id = 'JO1001';
    //     $jo = $this->jo->select('po_id')->orderBy('po_id', 'desc')->first();

    //     if($jo != null){
    //         if($jo->po_id != null){
    //             $num = str_replace('JO', '', $jo->po_id) + 1;
    //             $id = 'JO' . $num;
    //         }
    //     }
        
    //     return $id;
        
    // }




}