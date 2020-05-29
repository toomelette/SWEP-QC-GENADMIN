<?php 

namespace App\Core\Subscribers;

use App\Core\BaseClasses\BaseSubscriber;

class EmpHealthWeeklyPESubscriber extends BaseSubscriber{



    public function __construct(){
        parent::__construct();
    }



    public function subscribe($events){

        $events->listen('emp_health_weekly_pe.store', 'App\Core\Subscribers\EmpHealthWeeklyPESubscriber@onStore');
        $events->listen('emp_health_weekly_pe.update', 'App\Core\Subscribers\EmpHealthWeeklyPESubscriber@onUpdate');
        $events->listen('emp_health_weekly_pe.destroy', 'App\Core\Subscribers\EmpHealthWeeklyPESubscriber@onDestroy');

    }



    public function onStore($emp_health_weekly_pe){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_weekly_pe:fetchByEmpHealthId:'.$emp_health_weekly_pe->emp_health_id.':*');

        $this->session->flash('EMP_HEALTH_WEEKLY_PE_CREATE_SUCCESS', 'The Employee Weekly Physical Examination has been successfully created!');
        $this->session->flash('EMP_HEALTH_WEEKLY_PE_CREATE_SUCCESS_SLUG', $emp_health_weekly_pe->slug);

    }



    public function onUpdate($emp_health_weekly_pe){

        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_weekly_pe:fetchByEmpHealthId:'.$emp_health_weekly_pe->emp_health_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_weekly_pe:findBySlug:'. $emp_health_weekly_pe->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_weekly_pe:getBySlug:'. $emp_health_weekly_pe->slug .'');

        $this->session->flash('EMP_HEALTH_WEEKLY_PE_UPDATE_SUCCESS', 'The Employee Weekly Physical Examination has been successfully updated!');
        $this->session->flash('EMP_HEALTH_WEEKLY_PE_UPDATE_SUCCESS_SLUG', $emp_health_weekly_pe->slug);

    }



    public function onDestroy($emp_health_weekly_pe){

        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_weekly_pe:fetchByEmpHealthId:'.$emp_health_weekly_pe->emp_health_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_weekly_pe:findBySlug:'. $emp_health_weekly_pe->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_weekly_pe:getBySlug:'. $emp_health_weekly_pe->slug .'');


        $this->session->flash('EMP_HEALTH_WEEKLY_PE_DELETE_SUCCESS', 'The Employee Weekly Physical Examination has been successfully deleted!');
        $this->session->flash('EMP_HEALTH_WEEKLY_PE_DELETE_SUCCESS_SLUG', $emp_health_weekly_pe->slug);

    }



}