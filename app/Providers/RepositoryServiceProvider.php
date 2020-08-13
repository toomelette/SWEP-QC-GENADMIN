<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
 

class RepositoryServiceProvider extends ServiceProvider {
	


	public function register(){

		$this->app->bind('App\Core\Interfaces\UserInterface', 'App\Core\Repositories\UserRepository');

		$this->app->bind('App\Core\Interfaces\UserMenuInterface', 'App\Core\Repositories\UserMenuRepository');

		$this->app->bind('App\Core\Interfaces\UserSubmenuInterface', 'App\Core\Repositories\UserSubmenuRepository');


		$this->app->bind('App\Core\Interfaces\MenuInterface', 'App\Core\Repositories\MenuRepository');

		$this->app->bind('App\Core\Interfaces\SubmenuInterface', 'App\Core\Repositories\SubmenuRepository');

		$this->app->bind('App\Core\Interfaces\ProfileInterface', 'App\Core\Repositories\ProfileRepository');

		$this->app->bind('App\Core\Interfaces\EmpHealthInterface', 'App\Core\Repositories\EmpHealthRepository');

		$this->app->bind('App\Core\Interfaces\EmpHealthMedHistoryInterface', 'App\Core\Repositories\EmpHealthMedHistoryRepository');

		$this->app->bind('App\Core\Interfaces\EmpHealthWeeklyPEInterface', 'App\Core\Repositories\EmpHealthWeeklyPERepository');

		$this->app->bind('App\Core\Interfaces\EmpHealthAnnualPEInterface', 'App\Core\Repositories\EmpHealthAnnualPERepository');

		$this->app->bind('App\Core\Interfaces\DepartmentInterface', 'App\Core\Repositories\DepartmentRepository');
		
	}



}