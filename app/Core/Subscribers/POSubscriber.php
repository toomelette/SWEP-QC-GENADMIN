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

    }



    public function onStore($po){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetch:*');

        $this->session->flash('PO_CREATE_SUCCESS', 'The PO has been successfully created!');
        $this->session->flash('PO_CREATE_SUCCESS_SLUG', $po->slug);

    }



    public function onUpdate($po){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:findBySlug:'. $po->slug .'');

        $this->session->flash('PO_UPDATE_SUCCESS', 'The PO has been successfully updated!');
        $this->session->flash('PO_UPDATE_SUCCESS_SLUG', $po->slug);

    }



    public function onDestroy($po){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:po:findBySlug:'. $po->slug .'');

        $this->session->flash('PO_DELETE_SUCCESS', 'The PO has been successfully deleted!');
        $this->session->flash('PO_DELETE_SUCCESS_SLUG', $po->slug);

    }



}