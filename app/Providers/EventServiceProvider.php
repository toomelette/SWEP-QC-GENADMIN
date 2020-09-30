<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider{


   
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];




    public function boot(){

        parent::boot();

    }




    protected $subscribe = [

        'App\Core\Subscribers\UserSubscriber',
        'App\Core\Subscribers\ProfileSubscriber',
        'App\Core\Subscribers\MenuSubscriber',
        'App\Core\Subscribers\EmpHealthSubscriber',
        'App\Core\Subscribers\EmpHealthWeeklyPESubscriber',
        'App\Core\Subscribers\EmpHealthAnnualPESubscriber',
        'App\Core\Subscribers\DepartmentSubscriber',
        'App\Core\Subscribers\DivisionSubscriber',
        'App\Core\Subscribers\PRSubscriber',
        'App\Core\Subscribers\JRSubscriber',
        'App\Core\Subscribers\POSubscriber',
        
    ];





}
