<?php


/** Auth **/
Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});




/** Dashboard **/
Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status', 'check.user_route']], function () {


	/** HOME **/	
	Route::get('/home', 'HomeController@index')->name('home');


	/** USER **/   
	Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::post('/user/logout/{slug}', 'UserController@logout')->name('user.logout');
	Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
	Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
	Route::resource('user', 'UserController');


	/** PROFILE **/
	Route::get('/profile', 'ProfileController@details')->name('profile.details');
	Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
	Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
	Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');


	/** MENU **/
	Route::resource('menu', 'MenuController');


	/** EMPLOYEE HEALTH **/
	Route::patch('/emp_health/print_confirm/{slug}', 'EmpHealthController@printConfirm')->name('emp_health.print_confirm');
	Route::get('/emp_health/print_confirm/{slug}');
	Route::get('/emp_health/print/{slug}', 'EmpHealthController@print')->name('emp_health.print');
	Route::get('/emp_health/weekly_pe/{slug}', 'EmpHealthController@weeklyPE')->name('emp_health.weekly_pe');
	Route::get('/emp_health/annual_pe/{slug}', 'EmpHealthController@annualPE')->name('emp_health.annual_pe');
	Route::get('/emp_health/view_doc/{slug}', 'EmpHealthController@viewDoc')->name('emp_health.view_doc');
	Route::resource('emp_health', 'EmpHealthController');


	/** EMPLOYEE HEALTH WEEKLY PE **/
	Route::resource('emp_health_weekly_pe', 'EmpHealthWeeklyPEController');


	/** EMPLOYEE HEALTH ANNUAL PE **/
	Route::resource('emp_health_annual_pe', 'EmpHealthAnnualPEController');


	/** Department **/
	Route::resource('department', 'DepartmentController');


	/** Division **/
	Route::resource('division', 'DivisionController');


	/** Purchase Request **/
	Route::get('/pr/eu_create', 'PRController@euCreate')->name('pr.eu_create');
	Route::get('/pr/{slug}/eu_edit', 'PRController@euEdit')->name('pr.eu_edit');
	Route::get('/pr/eu_list', 'PRController@euIndex')->name('pr.eu_index');
	Route::post('/pr/set_pr_no/{slug}', 'PRController@setPRNO')->name('pr.set_pr_no');
	Route::get('/pr/print/{slug}/{page}', 'PRController@print')->name('pr.print');
	Route::get('/pr/reports', 'PRController@reports')->name('pr.reports');
	Route::get('/pr/reports_output', 'PRController@reportsOutput')->name('pr.reports_output');
	Route::resource('pr', 'PRController');


	/** Job Request **/
	Route::get('/jr/eu_create', 'JRController@euCreate')->name('jr.eu_create');
	Route::get('/jr/{slug}/eu_edit', 'JRController@euEdit')->name('jr.eu_edit');
	Route::get('/jr/eu_list', 'JRController@euIndex')->name('jr.eu_index');
	Route::post('/jr/set_jr_no/{slug}', 'JRController@setJRNO')->name('jr.set_jr_no');

	Route::get('/jr/print/{slug}/{page}', 'JRController@print')->name('jr.print');
	Route::resource('jr', 'JRController');


	/** Purchase Order **/
	Route::get('/po/eu_create', 'POController@euCreate')->name('po.eu_create');
	Route::get('/po/{slug}/eu_edit', 'POController@euEdit')->name('po.eu_edit');
	Route::get('/po/eu_list', 'POController@euIndex')->name('po.eu_index');
	Route::post('/po/set_po_no/{slug}', 'POController@setPONO')->name('po.set_po_no');

	Route::get('/po/print/{slug}/{page}', 'POController@print')->name('po.print');
	Route::resource('po', 'POController');


	/** Job Order **/
	Route::get('/jo/eu_create', 'JOController@euCreate')->name('jo.eu_create');
	Route::get('/jo/{slug}/eu_edit', 'JOController@euEdit')->name('jo.eu_edit');
	Route::get('/jo/eu_list', 'JOController@euIndex')->name('jo.eu_index');
	Route::post('/jo/set_jo_no/{slug}', 'JOController@setJONO')->name('jo.set_jo_no');

	Route::get('/jo/print/{slug}/{page}', 'JOController@print')->name('jo.print');
	Route::resource('jo', 'JOController');
	
	
});






/** Testing **/
// Route::get('/dashboard/test', function(){

	// $emps = App\Models\EmpMaster::get();

	// foreach ($emps as $data) {

	// 	$emp_obj = App\Models\EmpMaster::select('emp_id')->orderBy('emp_id', 'desc')->first();

	// 	$id = "";

 	//   if($emp_obj != null){
 	//       if($emp_obj->emp_id != null){
 	//           $num = str_replace('E', '', $emp_obj->emp_id) + 1;
 	//           $id = 'E' . $num;
 	//       }
 	//   }

	// 	$emp = App\Models\EmpMaster::find($data->id);
	// 	$emp->emp_id = $id;
	// 	$emp->save();
	// 	echo $emp->slug .'</br>';

	// }

	//return dd(Illuminate\Support\Str::random(16));

// });

