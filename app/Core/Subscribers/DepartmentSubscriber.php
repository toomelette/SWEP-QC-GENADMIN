<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class DepartmentSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('department.store', 'App\Core\Subscribers\DepartmentSubscriber@onStore');
        $events->listen('department.update', 'App\Core\Subscribers\DepartmentSubscriber@onUpdate');
        $events->listen('department.destroy', 'App\Core\Subscribers\DepartmentSubscriber@onDestroy');

    }



    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:getAll');

        $this->session->flash('DEPT_CREATE_SUCCESS', 'The Department has been successfully created!');

    }



    public function onUpdate($department){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:findBySlug:'. $department->slug .'');

        $this->session->flash('DEPT_UPDATE_SUCCESS', 'The Department has been successfully updated!');
        $this->session->flash('DEPT_UPDATE_SUCCESS_SLUG', $department->slug);

    }



    public function onDestroy($department){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:findBySlug:'. $department->slug .'');
        $this->session->flash('DEPT_DELETE_SUCCESS', 'The Department has been successfully deleted!');
        $this->session->flash('DEPT_DELETE_SUCCESS_SLUG', $department->slug);

    }



}