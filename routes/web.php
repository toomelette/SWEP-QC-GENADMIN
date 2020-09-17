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
	Route::get('/pr/print/{slug}/{page}', 'PRController@print')->name('pr.print');
	Route::resource('pr', 'PRController');
	
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

