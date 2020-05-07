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


	/** EMPLOYEE MEDICAL RECORD **/
	Route::get('/emp_med_record', 'EmpMedRecordController@index')->name('emp_med_record.index');
	Route::get('/emp_med_record/{emp_slug}', 'EmpMedRecordController@edit')->name('emp_med_record.edit');
	Route::post('/emp_med_record/{emp_slug}', 'EmpMedRecordController@update')->name('emp_med_record.update');
	
});






/** Testing **/
Route::get('/dashboard/test', function(){

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

});

