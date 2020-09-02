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

    }



    public function onStore(){
        
        // $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetch:*');
        // $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:getAll');

        $this->session->flash('PR_CREATE_SUCCESS', 'The PR has been successfully created!');

    }



    public function onUpdate($pr){

        // $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetch:*');
        // $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:getAll');
        // $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:findBySlug:'. $pr->slug .'');

        $this->session->flash('PR_UPDATE_SUCCESS', 'The PR has been successfully updated!');
        $this->session->flash('PR_UPDATE_SUCCESS_SLUG', $pr->slug);

    }



    public function onDestroy($pr){

        // $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:fetch:*');
        // $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:getAll');
        // $this->__cache->deletePattern(''. config('app.name') .'_cache:pr:findBySlug:'. $pr->slug .'');

        $this->session->flash('PR_DELETE_SUCCESS', 'The PR has been successfully deleted!');
        $this->session->flash('PR_DELETE_SUCCESS_SLUG', $pr->slug);

    }



}