<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class PRSubscriber extends BaseSubscriber{



    public function __construct(){
        parent::__construct();
    }



    public function subscribe($events){

        $events->listen('pr.store', 'App\Core\Subscribers\PRSubscriber@onStore');
        $events->listen('pr.update', 'App\Core\Subscribers\PRSubscriber@onUpdate');
        $events->listen('pr.destroy', 'App\Core\Subscribers\PRSubscriber@onDestroy');
        $events->listen('pr.set_pr_no', 'App\Core\Subscribers\PRSubscriber@onSetPRNo');

    }



    public function onStore($pr){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetchByDeptId:'.$pr->dept_id.':*');

        $this->session->flash('PR_CREATE_SUCCESS', 'The PR has been successfully created!');
        $this->session->flash('PR_CREATE_SUCCESS_SLUG', $pr->slug);

    }



    public function onUpdate($pr){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetchByDeptId:'.$pr->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:findBySlug:'. $pr->slug .'');

        $this->session->flash('PR_UPDATE_SUCCESS', 'The PR has been successfully updated!');
        $this->session->flash('PR_UPDATE_SUCCESS_SLUG', $pr->slug);

    }



    public function onDestroy($pr){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetchByDeptId:'.$pr->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:findBySlug:'. $pr->slug .'');

        $this->session->flash('PR_DELETE_SUCCESS', 'The PR has been successfully deleted!');
        $this->session->flash('PR_DELETE_SUCCESS_SLUG', $pr->slug);

    }



    public function onSetPRNo($pr){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetchByDeptId:'.$pr->dept_id.':*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:findBySlug:'. $pr->slug .'');

        $this->session->flash('PR_SET_PR_NO_SUCCESS', 'PR No. successfully set!');
        $this->session->flash('PR_SET_PR_NO_SUCCESS_SLUG', $pr->slug);

    }



}