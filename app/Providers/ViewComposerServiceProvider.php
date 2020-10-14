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
        

        // Departments
        View::composer(['dashboard.division.create', 
                        'dashboard.division.edit', 
                        'dashboard.user.create', 
                        'dashboard.user.edit', 
                        'dashboard.pr.create', 
                        'dashboard.pr.edit',
                        'dashboard.pr.eu_create',
                        'dashboard.pr.eu_edit',
                        'dashboard.jr.create', 
                        'dashboard.jr.edit',
                        'dashboard.jr.eu_create',
                        'dashboard.jr.eu_edit',
                        'dashboard.po.create', 
                        'dashboard.po.edit',
                        'dashboard.jo.create', 
                        'dashboard.jo.edit', ], 'App\Core\ViewComposers\DepartmentComposer');
        

        // Divisions
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit', 
                        'dashboard.pr.create', 
                        'dashboard.pr.edit',
                        'dashboard.pr.eu_create',
                        'dashboard.pr.eu_edit',
                        'dashboard.jr.create', 
                        'dashboard.jr.edit',
                        'dashboard.jr.eu_create',
                        'dashboard.jr.eu_edit',
                        'dashboard.po.create', 
                        'dashboard.po.edit',
                        'dashboard.jo.create', 
                        'dashboard.jo.edit'], 'App\Core\ViewComposers\DivisionComposer');
        

        // JR
        View::composer(['dashboard.jo.create', 
                        'dashboard.jo.edit'], 'App\Core\ViewComposers\JRComposer');
         
    }

    




    
    public function register(){

      


    
    }




}
