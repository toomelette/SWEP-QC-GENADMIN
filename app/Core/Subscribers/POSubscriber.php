<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class POSubscriber extends BaseSubscriber{



    public function __construct(){
        parent::__construct();
    }



    public function subscribe($events){

        $events->listen('po.store', 'App\Core\Subscribers\POSubscriber@onStore');
        $events->listen('po.update', 'App\Core\Subscribers\POSubscriber@onUpdate');
        $events->listen('po.destroy', 'App\Core\Subscribers\POSubscriber@onDestroy');
        $events->listen('po.set_po_no', 'App\Core\Subscribers\POSubscriber@onSetPONo');

    }



    public function onStore($po){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetchByDeptId:'.$po->dept_id.':*');

        $this->session->flash('PO_CREATE_SUCCESS', 'The PO has been successfully created!');
        $this->session->flash('PO_CREATE_SUCCESS_SLUG', $po->slug);

    }



    public function onUpdate($po){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetchByDeptId:'.$po->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:findBySlug:'. $po->slug .'');

        $this->session->flash('PO_UPDATE_SUCCESS', 'The PO has been successfully updated!');
        $this->session->flash('PO_UPDATE_SUCCESS_SLUG', $po->slug);

    }



    public function onDestroy($po){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetchByDeptId:'.$po->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:findBySlug:'. $po->slug .'');

        $this->session->flash('PO_DELETE_SUCCESS', 'The PO has been successfully deleted!');
        $this->session->flash('PO_DELETE_SUCCESS_SLUG', $po->slug);

    }



    public function onSetPONo($po){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetchByDeptId:'.$po->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:findBySlug:'. $po->slug .'');

        $this->session->flash('PO_SET_PO_NO_SUCCESS', 'PO No. successfully set!');
        $this->session->flash('PO_SET_PO_NO_SUCCESS_SLUG', $po->slug);

    }



}