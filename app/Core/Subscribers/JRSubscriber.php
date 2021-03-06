<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class JRSubscriber extends BaseSubscriber{



    public function __construct(){
        parent::__construct();
    }



    public function subscribe($events){

        $events->listen('jr.store', 'App\Core\Subscribers\JRSubscriber@onStore');
        $events->listen('jr.update', 'App\Core\Subscribers\JRSubscriber@onUpdate');
        $events->listen('jr.destroy', 'App\Core\Subscribers\JRSubscriber@onDestroy');
        $events->listen('jr.set_jr_no', 'App\Core\Subscribers\JRSubscriber@onSetJRNo');

    }



    public function onStore($jr){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:fetchByDeptId:'.$jr->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:getAll');

        $this->session->flash('JR_CREATE_SUCCESS', 'The JR has been successfully created!');
        $this->session->flash('JR_CREATE_SUCCESS_SLUG', $jr->slug);

    }



    public function onUpdate($jr){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:fetchByDeptId:'.$jr->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:findBySlug:'. $jr->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:getAll');

        $this->session->flash('JR_UPDATE_SUCCESS', 'The JR has been successfully updated!');
        $this->session->flash('JR_UPDATE_SUCCESS_SLUG', $jr->slug);

    }



    public function onDestroy($jr){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:fetchByDeptId:'.$jr->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:findBySlug:'. $jr->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:getAll');
        
        $this->session->flash('JR_DELETE_SUCCESS', 'The JR has been successfully deleted!');
        $this->session->flash('JR_DELETE_SUCCESS_SLUG', $jr->slug);

    }



    public function onSetJRNo($jr){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:fetchByDeptId:'.$jr->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:jr:findBySlug:'. $jr->slug .'');

        $this->session->flash('JR_SET_JR_NO_SUCCESS', 'JR No. successfully set!');
        $this->session->flash('JR_SET_JR_NO_SUCCESS_SLUG', $jr->slug);

    }



}