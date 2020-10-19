<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class JOSubscriber extends BaseSubscriber{



    public function __construct(){
        parent::__construct();
    }



    public function subscribe($events){

        $events->listen('jo.store', 'App\Core\Subscribers\JOSubscriber@onStore');
        $events->listen('jo.update', 'App\Core\Subscribers\JOSubscriber@onUpdate');
        $events->listen('jo.destroy', 'App\Core\Subscribers\JOSubscriber@onDestroy');
        $events->listen('jo.set_jo_no', 'App\Core\Subscribers\JOSubscriber@onSetJONo');

    }



    public function onStore($jo){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:fetchByDeptId:'.$jo->dept_id.':*');

        $this->session->flash('JO_CREATE_SUCCESS', 'The JO has been successfully created!');
        $this->session->flash('JO_CREATE_SUCCESS_SLUG', $jo->slug);

    }



    public function onUpdate($jo){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:findBySlug:'. $jo->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:fetchByDeptId:'.$jo->dept_id.':*');

        $this->session->flash('JO_UPDATE_SUCCESS', 'The JO has been successfully updated!');
        $this->session->flash('JO_UPDATE_SUCCESS_SLUG', $jo->slug);

    }



    public function onDestroy($jo){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:findBySlug:'. $jo->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:fetchByDeptId:'.$jo->dept_id.':*');

        $this->session->flash('JO_DELETE_SUCCESS', 'The JO has been successfully deleted!');
        $this->session->flash('JO_DELETE_SUCCESS_SLUG', $jo->slug);

    }



    public function onSetJONo($jo){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:fetchByDeptId:'.$jo->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jo:findBySlug:'. $jo->slug .'');

        $this->session->flash('JO_SET_JO_NO_SUCCESS', 'JO No. successfully set!');
        $this->session->flash('JO_SET_JO_NO_SUCCESS_SLUG', $jo->slug);

    }



}