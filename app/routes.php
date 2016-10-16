<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@showLogin'));
Route::get('login', array('as' => 'login', function () { }));
Route::get('register', function()
{
	return View::make('contractors.create');
});  

 Route::get('register', array(
  'uses' => 'ContractorsController@create',
  'as' => 'contractors.create'
));  
Route::get('agreement', array('as' => 'agreement', function () { return View::make('agreement'); }));
 Route::post('projectinfo', array(
  'uses' => 'ProjectsController@projectinfo',
  'as' => 'projects.projectinfo'
))->before('auth'); 

Route::post('projectjobtype', array(
  'uses' => 'ProjectsController@projectjobtype',
   'as' => 'projects.projectjobtype'
))->before('auth');  
Route::post('updatedescription', array(
  'uses' => 'ProjectsController@updatedescription',
   'as' => 'projects.updatedescription'
))->before('auth');  
Route::get('projects/{id}/clientprojects', 'ProjectsController@clientprojects')->before('auth');
Route::get('taskcategories/{id}/defaltctry', 'TaskcategoriesController@defaltctry')->before('auth');
Route::get('jobtypes/{id}/updatesdefault', 'JobtypesController@updatesdefault')->before('auth');

Route::get('estimates/{id}/download', 'EstimatesController@download')->before('auth');

Route::get('projects/{id}/delete', 'ProjectsController@delete')->before('auth');

Route::get('projects/{id}/deletesepc', 'ProjectsController@deletesepc')->before('auth');

Route::get('projects/{id}/showsepc', 'ProjectsController@showsepc')->before('auth');

Route::get('invoices/{id}/download', 'InvoicesController@download')->before('auth');

Route::get('resources/{id}/download', 'ResourcesController@download')->before('auth');

Route::get('notes/{id}/destroy', 'NotesController@destroy')->before('auth');

Route::get('projects/{id}/spec', 'ProjectsController@spec')->before('auth');

Route::get('projects/{id}/projecthistory', 'ProjectsController@projecthistory')->before('auth');

Route::get('clients/{id}/send', 'ClientsController@send')->before('auth');

///Route::get('clients/{id}/emailsend', 'ClientsController@emailsend')->before('auth');

 Route::post('emailsend', array(
  'uses' => 'ClientsController@emailsend',
   'as' => 'ClientsController.emailsend'
))->before('auth');

	//Route::get('dashboard', array('as' => 'dashboard', function () { return View::make('dashboard'); }))->before('auth');
	//Route::get('admin', array('as' => 'admin', function () { return View::make('admin'); }))->before('auth');
	
	Route::get('admin', array('uses' => 'HomeController@showAdmin'));
	Route::get('dashboard', array('uses' => 'HomeController@showLogin'));									

	//Route::resource('contractors', 'ContractorsController');
Route::group(array('before' => 'auth'), function()
{

	//echo Hash::make("3deufosm");
	//echo Hash::make("contractor");
		

		 Route::get('contractors/{id}/editadmin', array(
		  'uses' => 'ContractorsController@editadmin',
		  'as' => 'contractors.editadmin'
		 )); 

		Route::get('contractors/{id}/editadmin', 'ContractorsController@editadmin')->before('auth');
		Route::resource('units', 'UnitsController');
		Route::resource('contractors', 'ContractorsController');
		Route::resource('clients', 'ClientsController');
		Route::resource('jobtypes', 'JobtypesController');
		Route::resource('taskcategories', 'TaskcategoriesController');
		Route::resource('tasks', 'TasksController');
		Route::resource('projects', 'ProjectsController');
		Route::resource('estimates', 'EstimatesController');
		Route::resource('invoices', 'InvoicesController');
		Route::resource('resources', 'ResourcesController');
		Route::resource('notes', 'NotesController');
		Route::resource('projecttypes', 'ProjecttypesController');
});

// route to show the login form 
Route::get('login', array('uses' => 'HomeController@showLogin'));
// route to process the form
Route::post('login', array('uses' => 'HomeController@doLogin'));
Route::get('logout', array('uses' => 'HomeController@doLogout'));
 Route::post('create', array(
  'uses' => 'ContractorsController@store',
  'as' => 'contractors.store'
));
//Route::get('getremind', array('uses' => 'RemindersController@getRemind'));
Route::get('password/reset', array(
  'uses' => 'RemindersController@getRemind',
  'as' => 'password.remind'
));
 Route::get('updatespecification', array(
		  'uses' => 'ProjectsController@updatespecification',
		  'as' => 'ProjectsController.updatespecification'
		 )); 
 Route::get('updatespecarchive', array(
		  'uses' => 'ProjectsController@updatespecarchive',
		  'as' => 'ProjectsController.updatespecarchive'
		 )); 		 
Route::get('description', array(
	  'uses' => 'ProjectsController@description',
	  'as' => 'ProjectsController.description'
	 ));  
Route::get('historydescription', array(
	  'uses' => 'ProjectsController@historydescription',
	  'as' => 'ProjectsController.historydescriptions'
	 )); 	 
/*
/ Forgot password (POST)
 */
 Route::post('/password/forgot-password', array(
	'as' => 'forgot-password-post',
	'uses' => 'PasswordController@postForgotPassword'
	));
	
/*
/ Forgot password (GET)
 */
 Route::get('/password/forgot-password', array(
	'as' => 'forgot-password',
	'uses' => 'PasswordController@getForgotPassword'
	));
	
Route::get('/password/recover/{code}', array(
	'as' => 'recover-password',
	'uses' => 'PasswordController@getRecoverPassword'

	));	
 Route::get('changepassword', array(
		  'uses' => 'ContractorsController@changepassword',
		  'as' => 'contractors.changepassword'
		 ))->before('auth');
Route::get('billingifo', array(
		  'uses' => 'ContractorsController@billingifo',
		  'as' => 'contractors.billingifo'
		 ))->before('auth');		 
Route::post('storepassword', array(
	'uses' => 'ContractorsController@storepassword',
	'as' => 'contractors.storepassword'
))->before('auth'); 
Route::post('storebillingifo', array(
	'uses' => 'ContractorsController@storebillingifo',
	'as' => 'contractors.storebillingifo'
))->before('auth'); 
/**
Route::get('notes-alert', array(
		  'uses' => 'RemindersController@notesReminder',
		  'as' => 'reminders.notesalert'
		 )); **/