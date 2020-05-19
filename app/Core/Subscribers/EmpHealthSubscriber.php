<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class EmpHealthSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('emp_health.store', 'App\Core\Subscribers\EmpHealthSubscriber@onStore');
        $events->listen('emp_health.update', 'App\Core\Subscribers\EmpHealthSubscriber@onUpdate');
        $events->listen('emp_health.destroy', 'App\Core\Subscribers\EmpHealthSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health:fetch:*');

        $this->session->flash('EMP_HEALTH_CREATE_SUCCESS', 'The Employee Health Record has been successfully created!');

    }





    public function onUpdate($emp_health){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health:findBySlug:'. $emp_health->slug .'');

        $this->session->flash('EMP_HEALTH_UPDATE_SUCCESS', 'The Employee Health Record has been successfully updated!');
        $this->session->flash('EMP_HEALTH_UPDATE_SUCCESS_SLUG', $emp_health->slug);

    }



    public function onDestroy($emp_health){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health:findBySlug:'. $emp_health->slug .'');

        $this->session->flash('EMP_HEALTH_DELETE_SUCCESS', 'The Employee Health Record has been successfully deleted!');
        $this->session->flash('EMP_HEALTH_DELETE_SUCCESS_SLUG', $emp_health->slug);

    }





}