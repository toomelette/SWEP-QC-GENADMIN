<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class DivisionSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('division.store', 'App\Core\Subscribers\DivisionSubscriber@onStore');
        $events->listen('division.update', 'App\Core\Subscribers\DivisionSubscriber@onUpdate');
        $events->listen('division.destroy', 'App\Core\Subscribers\DivisionSubscriber@onDestroy');

    }



    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:divisions:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:divisions:getAll');

        $this->session->flash('DIV_CREATE_SUCCESS', 'The Division has been successfully created!');

    }



    public function onUpdate($division){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:divisions:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:divisions:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:divisions:findBySlug:'. $division->slug .'');

        $this->session->flash('DIV_UPDATE_SUCCESS', 'The Division has been successfully updated!');
        $this->session->flash('DIV_UPDATE_SUCCESS_SLUG', $division->slug);

    }



    public function onDestroy($division){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:divisions:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:divisions:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:divisions:findBySlug:'. $division->slug .'');
        $this->session->flash('DIV_DELETE_SUCCESS', 'The Division has been successfully deleted!');
        $this->session->flash('DIV_DELETE_SUCCESS_SLUG', $division->slug);

    }



}