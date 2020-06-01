<?php 

namespace App\Core\Subscribers;

use App\Core\BaseClasses\BaseSubscriber;

class EmpHealthAnnualPESubscriber extends BaseSubscriber{



    public function __construct(){
        parent::__construct();
    }



    public function subscribe($events){

        $events->listen('emp_health_annual_pe.store', 'App\Core\Subscribers\EmpHealthAnnualPESubscriber@onStore');
        $events->listen('emp_health_annual_pe.update', 'App\Core\Subscribers\EmpHealthAnnualPESubscriber@onUpdate');
        $events->listen('emp_health_annual_pe.destroy', 'App\Core\Subscribers\EmpHealthAnnualPESubscriber@onDestroy');

    }



    public function onStore($emp_health_annual_pe){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_annual_pe:fetchByEmpHealthId:'.$emp_health_annual_pe->emp_health_id.':*');

        $this->session->flash('EMP_HEALTH_ANNUAL_PE_CREATE_SUCCESS', 'The Employee Annual Physical Examination has been successfully created!');
        $this->session->flash('EMP_HEALTH_ANNUAL_PE_CREATE_SUCCESS_SLUG', $emp_health_annual_pe->slug);

    }



    public function onUpdate($emp_health_annual_pe){

        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_annual_pe:fetchByEmpHealthId:'.$emp_health_annual_pe->emp_health_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_annual_pe:findBySlug:'. $emp_health_annual_pe->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_annual_pe:getBySlug:'. $emp_health_annual_pe->slug .'');

        $this->session->flash('EMP_HEALTH_ANNUAL_PE_UPDATE_SUCCESS', 'The Employee Annual Physical Examination has been successfully updated!');
        $this->session->flash('EMP_HEALTH_ANNUAL_PE_UPDATE_SUCCESS_SLUG', $emp_health_annual_pe->slug);

    }



    public function onDestroy($emp_health_annual_pe){

        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_annual_pe:fetchByEmpHealthId:'.$emp_health_annual_pe->emp_health_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_annual_pe:findBySlug:'. $emp_health_annual_pe->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:emp_health_annual_pe:getBySlug:'. $emp_health_annual_pe->slug .'');


        $this->session->flash('EMP_HEALTH_ANNUAL_PE_DELETE_SUCCESS', 'The Employee Annual Physical Examination has been successfully deleted!');
        $this->session->flash('EMP_HEALTH_ANNUAL_PE_DELETE_SUCCESS_SLUG', $emp_health_annual_pe->slug);

    }



}