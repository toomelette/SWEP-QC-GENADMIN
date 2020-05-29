<?php


// Submenu
Route::get('/submenu/select_submenu_byMenuId/{menu_id}', 'Api\ApiSubmenuController@selectSubmenuByMenuId')
		->name('selectSubmenuByMenuId');

// Weekly PE
Route::get('/emp_health_weekly_pe/{slug}/edit', 'Api\ApiEmpHealthWeeklyPEController@edit')
		->name('api.emp_health_weekly_pe.edit');



