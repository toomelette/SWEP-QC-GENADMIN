<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        /** VIEW COMPOSERS  **/


        // USERMENU
        View::composer('layouts.admin-sidenav', 'App\Core\ViewComposers\UserMenuComposer');


        // USER SUBMENU
        View::composer(['*'], 'App\Core\ViewComposers\UserSubmenuComposer');


        // MENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\MenuComposer');
        

        // SUBMENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\SubmenuComposer');
        

        // MEDICAL HISTORY
        View::composer(['dashboard.emp_health.create', 
                        'dashboard.emp_health.edit', 
                        'dashboard.emp_health.show', 
                        'printables.emp_health.declaration_form'], 'App\Core\ViewComposers\MedicalHistoryComposer');
         
    }

    




    
    public function register(){

      


    
    }




}
