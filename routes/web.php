<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/debug/create', 'InitialUserController@debugcreate');
// Route::post('/debug/create', ['as' => 'debugstore', 'uses' => 'InitialUserController@debugstore']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/reset', 'Admin\PasswordController@initResetPwd');
    Route::post('/reset', 'Admin\PasswordController@sendEmailPwd');
//    Route::get('/reset/{time}/{id}/{mdemail}/{mdrandom}', 'Admin\PasswordController@resetPwd');
    Route::get('/reset/{time}/{id}/{mdemail}/{mdrandom}', function ($time, $id) {
        $cur_time = time();
        $user = \App\User::where('id', $id)->first();
        $name = $user->first_name.' '.$user->last_name;
        if($cur_time - $time > 1800) {
            echo "Expired Link";
        } else {
            $url = URL::current();
            return view('admin.reset', [
                'url' => $url,
                'name' => $name,
            ]);
        }
    });
    Route::post('/reset/{time}/{id}/{mdemail}/{mdrandom}', 'Admin\PasswordController@storeNewPwd');
});
Route::get('/login', 'LoginController@login');
Route::any('/verify', ['as' => 'generate', 'uses' => 'LoginController@authenticate']);
Route::post('/home', ['as' => 'vrfy', 'uses' => 'LoginController@vrfy']);
Route::get('/email', 'LoginController@basic_email');
//Route::post('/')
//    Route::get('/login', ['as' => 'code', 'uses' => 'LoginController@generatecode']);
//Route::resource('/vrfy', 'LoginController', ['only' => ['authenticate', 'vrfy']]);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['admin']], function()
{
    Route::get('', ['as' => 'admin_dashboard', 'uses' => 'ActivityManagement\ActivityController@view']);
    Route::get('user/view', 'UserManagement\UserController@view');
    Route::get('user/create', 'RegistrationController@create');
    Route::post('user/create', ['as' => 'admin.user.store', 'uses' => 'RegistrationController@store']);
    Route::get('case/create', 'CaseManagement\CaseController@create');
    Route::post('case/create', ['as' => 'admin.case.store', 'uses' => 'CaseManagement\CaseController@store']);
    Route::get('case/view', ['uses' => 'CaseManagement\CaseController@view']);
    Route::get('case/{id}/view', ['uses' => 'CaseManagement\CaseController@viewdetail']);
    Route::post('case/{id}/edit', 'CaseManagement\CaseController@update');
    Route::get('case/{id}/active', ['uses' => 'CaseManagement\CaseController@active']);
    Route::get('case/{id}/inactive', ['uses' => 'CaseManagement\CaseController@inactive']);
    Route::post('case/{id}/delete', ['uses' => 'CaseManagement\CaseController@delete']);
    Route::get('case/{id}/account', ['uses' => 'CaseManagement\CaseController@createaccount']);
    Route::post('case/{id}/account', ['as' => 'admin.case.create.account', 'uses' => 'CaseManagement\CaseController@storeaccount']);
    Route::post('case/upload', 'CaseManagement\FileuploadingController@showfileupload');
    Route::post('case/upload/avatar', 'CaseManagement\FileuploadingController@uploadAvatar');
    Route::post('case/doc/{id}/edit', 'CaseManagement\CaseController@editfile');
    Route::get('case/doc/{id}/delete', 'CaseManagement\CaseController@deletefile');
    Route::post('case/workhistory', 'CaseManagement\CaseController@storeWorkHistory');
    Route::post('case/workhistory/{id}/edit', 'CaseManagement\CaseController@editWorkHistory');
    Route::get('case/workhistory/{id}/delete', 'CaseManagement\CaseController@deleteWorkHistory');
    Route::post('case/eduhistory', 'CaseManagement\CaseController@storeEduHistory');
    Route::post('case/eduhistory/{id}/edit', 'CaseManagement\CaseController@editEduHistory');
    Route::get('case/eduhistory/{id}/delete', 'CaseManagement\CaseController@deleteEduHistory');
    Route::post('case/addcontacts', 'CaseManagement\CaseController@storeAddContacts');
    Route::post('case/addcontacts/{id}/edit', 'CaseManagement\CaseController@editAddContacts');
    Route::get('case/addcontacts/{id}/delete', 'CaseManagement\CaseController@deleteAddContacts');
    Route::post('case/addcontactinfo', 'CaseManagement\CaseController@addContactInfo');
    Route::post('case/addaddress', 'CaseManagement\CaseController@addAddress');
    Route::post('case/contact/address/{id}/edit', 'CaseManagement\CaseController@editAddress');
    Route::get('case/contact/address/{id}/delete', 'CaseManagement\CaseController@deleteAddress');
    Route::post('case/addphone', 'CaseManagement\CaseController@addPhone');
    Route::post('case/contact/phone/{id}/edit', 'CaseManagement\CaseController@editPhone');
    Route::get('case/contact/phone/{id}/delete', 'CaseManagement\CaseController@deletePhone');
    Route::post('case/addemail', 'CaseManagement\CaseController@addEmail');
    Route::post('case/contact/email/{id}/edit', 'CaseManagement\CaseController@editEmail');
    Route::get('case/contact/email/{id}/delete', 'CaseManagement\CaseController@deleteEmail');
    Route::get('settings/program', 'SettingsManagement\SettingsController@viewProgramSettings');
    Route::post('settings/program/add', 'SettingsManagement\SettingsController@addProgramSettings');
    Route::post('settings/program/{id}/edit', 'SettingsManagement\SettingsController@editProgramSettings');
    Route::get('settings/program/{id}/delete', 'SettingsManagement\SettingsController@deleteProgramSettings');
    Route::get('settings/doctype', 'SettingsManagement\SettingsController@viewDocumentSettings');
    Route::post('settings/doctype/add', 'SettingsManagement\SettingsController@addDocumentSettings');
    Route::post('settings/doctype/{id}/edit', 'SettingsManagement\SettingsController@editDocumentSettings');
    Route::get('settings/doctype/{id}/delete', 'SettingsManagement\SettingsController@deleteDocumentSettings');
    Route::get('settings/password', 'SettingsManagement\SettingsController@password');
    Route::post('settings/password/reset', 'SettingsManagement\SettingsController@resetPassword');
    Route::get('user/{id}/view', 'UserManagement\UserController@viewdetail');
    Route::post('user/{id}/edit', 'UserManagement\UserController@update');
    Route::get('user/{id}/active', 'UserManagement\UserController@active');
    Route::get('user/{id}/inactive', 'UserManagement\UserController@inactive');
    Route::post('activity/create', 'ActivityManagement\ActivityController@create');
    Route::get('{id}/view', 'ActivityManagement\ActivityController@viewdetail');
    Route::post('{id}/edit', 'ActivityManagement\ActivityController@update');
    Route::get('{id}/delete', 'ActivityManagement\ActivityController@delete');
    Route::post('case/addactivity', 'ActivityManagement\ActivityController@create');
    Route::get('settings/survey', 'SettingsManagement\SettingsController@survey');
    Route::post('settings/survey/add', 'SettingsManagement\SettingsController@addSurvey');
    Route::get('settings/survey/{id}/delete', 'SettingsManagement\SettingsController@deleteSurvey');
    Route::post('settings/survey/{id}/edit', 'SettingsManagement\SettingsController@editSurvey');
//    Route::get('settings/password', 'PasswordController@')
////    Route::get('admin_logout', ['uses' => 'Admin\AdminController@logout']);
//    Route::get('/create', 'RegistrationController@create');
//    Route::post('/create', ['as' => 'store', 'uses' => 'RegistrationController@store']);
});
Route::group(['namespace' => 'Manager', 'prefix' => 'manager', 'middleware' => ['manager']], function()
{

    Route::get('', ['as' => 'manager_dashboard', 'uses' => 'ActivityManagement\ActivityController@view']);
    Route::get('user/view', 'UserManagement\UserController@view');
//    Route::get('user/create', 'RegistrationController@create');
//    Route::post('user/create', ['as' => 'manager.user.store', 'uses' => 'RegistrationController@store']);
    Route::get('case/create', 'CaseManagement\CaseController@create');
    Route::post('case/create', ['as' => 'manager.case.store', 'uses' => 'CaseManagement\CaseController@store']);
    Route::get('case/view', ['uses' => 'CaseManagement\CaseController@view']);
    Route::get('case/{id}/view', ['uses' => 'CaseManagement\CaseController@viewdetail']);
    Route::post('case/{id}/edit', 'CaseManagement\CaseController@update');
    Route::get('case/{id}/active', ['uses' => 'CaseManagement\CaseController@active']);
    Route::get('case/{id}/inactive', ['uses' => 'CaseManagement\CaseController@inactive']);
//    Route::post('case/{id}/delete', ['uses' => 'CaseManagement\CaseController@delete']);
    Route::get('case/{id}/account', ['uses' => 'CaseManagement\CaseController@createaccount']);
    Route::post('case/{id}/account', ['as' => 'manager.case.create.account', 'uses' => 'CaseManagement\CaseController@storeaccount']);
    Route::post('case/upload', 'CaseManagement\FileuploadingController@showfileupload');
    Route::post('case/upload/avatar', 'CaseManagement\FileuploadingController@uploadAvatar');
    Route::post('case/doc/{id}/edit', 'CaseManagement\CaseController@editfile');
    Route::get('case/doc/{id}/delete', 'CaseManagement\CaseController@deletefile');
    Route::post('case/workhistory', 'CaseManagement\CaseController@storeWorkHistory');
    Route::post('case/workhistory/{id}/edit', 'CaseManagement\CaseController@editWorkHistory');
    Route::get('case/workhistory/{id}/delete', 'CaseManagement\CaseController@deleteWorkHistory');
    Route::post('case/eduhistory', 'CaseManagement\CaseController@storeEduHistory');
    Route::post('case/eduhistory/{id}/edit', 'CaseManagement\CaseController@editEduHistory');
    Route::get('case/eduhistory/{id}/delete', 'CaseManagement\CaseController@deleteEduHistory');
    Route::post('case/addcontacts', 'CaseManagement\CaseController@storeAddContacts');
    Route::post('case/addcontacts/{id}/edit', 'CaseManagement\CaseController@editAddContacts');
    Route::get('case/addcontacts/{id}/delete', 'CaseManagement\CaseController@deleteAddContacts');
    Route::post('case/addcontactinfo', 'CaseManagement\CaseController@addContactInfo');
    Route::post('case/addaddress', 'CaseManagement\CaseController@addAddress');
    Route::post('case/contact/address/{id}/edit', 'CaseManagement\CaseController@editAddress');
    Route::get('case/contact/address/{id}/delete', 'CaseManagement\CaseController@deleteAddress');
    Route::post('case/addphone', 'CaseManagement\CaseController@addPhone');
    Route::post('case/contact/phone/{id}/edit', 'CaseManagement\CaseController@editPhone');
    Route::get('case/contact/phone/{id}/delete', 'CaseManagement\CaseController@deletePhone');
    Route::post('case/addemail', 'CaseManagement\CaseController@addEmail');
    Route::post('case/contact/email/{id}/edit', 'CaseManagement\CaseController@editEmail');
    Route::get('case/contact/email/{id}/delete', 'CaseManagement\CaseController@deleteEmail');
    Route::get('user/view', ['uses' => 'UserManagement\UserController@view']);
    Route::get('user/{id}/view', 'UserManagement\UserController@viewdetail');
    Route::post('user/{id}/edit', 'UserManagement\UserController@update');
    Route::post('activity/create', 'ActivityManagement\ActivityController@create');
    Route::get('{id}/view', 'ActivityManagement\ActivityController@viewdetail');
    Route::post('{id}/edit', 'ActivityManagement\ActivityController@update');
    Route::post('case/addactivity', 'ActivityManagement\ActivityController@create');
//    Route::get('manager/case/create', 'CaseManagement\CaseController@create');
//    Route::get('manager_logout', ['uses' => 'Manager\ManagerController@logout']);
});
Route::group(['namespace' => 'Staff', 'prefix' => 'staff', 'middleware' => ['staff']], function ()
{

    Route::get('', ['as' => 'staff_dashboard', 'uses' => 'ActivityManagement\ActivityController@view']);
    Route::get('case/view', ['uses' => 'CaseManagement\CaseController@view']);
    Route::get('case/{id}/view', ['uses' => 'CaseManagement\CaseController@viewdetail']);
    Route::get('user/view', ['uses' => 'UserManagement\UserController@view']);
    Route::get('user/{id}/view', 'UserManagement\UserController@viewdetail');
    Route::post('user/{id}/edit', 'UserManagement\UserController@update');
    Route::post('activity/create', 'ActivityManagement\ActivityController@create');
    Route::get('{id}/view', 'ActivityManagement\ActivityController@viewdetail');
//    Route::post('{id}/edit', 'ActivityManagement\ActivityController@update');
//    Route::get('staff_logout', ['uses' => 'Staff\StaffController@logout']);
});
Route::group(['middleware' => ['youth']], function () {
    Route::get('youth',['as' => 'youth_dashboard', 'uses' => 'Youth\YouthController@getHome']);
//    Route::get('youth_logout', ['uses' => 'Youth\YouthController@logout']);
});
Route::get('/fail', function() {
    return view('errors.403');
});
Route::get('/error', function () {
    return view('errors.503');
});
Route::get('/logout', ['uses' => 'LoginController@logout']);

//Route::get('/uploadfile', 'FileuploadingController@index');
//Route::post('/uploadfile', 'FileuploadingController@showfileupload');
