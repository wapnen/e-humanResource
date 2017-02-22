<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
       //Alert::message('Robots are working!');
   
   			
    	 if (!Auth::guest()){
    	 	if (Auth::user()->role == "Cashier" ) {
    	 		return view('hospital.add');
    	 	}
    	 	 else{
    	 	 return view('welcome');
    	 }
    	 
    	 }
    	 else{
    	 	 return view('welcome');
    	}
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){
	Route::post('/vet', ['uses' => 'PurchaseController@vet', 'as' => 'vet']);
	Route::post('/purchasecheque/{id}', ['uses' => 'PurchaseController@cheque', 'as' => 'purchasecheque']);
	Route::post('/allapplications' , 'ApplicationsController@showall');
	Route::post('/ammount' , ['uses' => 'FoodController@ammount', 'as' => 'ammount']);
	Route::get('/facilities' , ['uses' => 'DepartmentController@facility', 'as' => 'facilities']);
	Route::get('/facilityaction' , ['uses' => 'DepartmentController@facilityAction', 'as' => 'facilityaction']);
	Route::get('/facilitystats' , ['uses' => 'DepartmentController@statistics', 'as' => 'statistics']);
	Route::resource('/facility', 'FacilityController');
	Route::resource('/facilityDays' , 'FacilityDaysController');
	Route::resource('/applications' , 'ApplicationsController');
	Route::resource('/requests' , 'RequestsController');
	Route::get('/feed' , ['uses' => 'FoodController@food', 'as' => 'feed']);
	Route::get('/foodstats' , ['uses' => 'FoodController@statistics', 'as' => 'foodstats']);
	Route::resource('/food' , 'FoodController');
	Route::resource('/department' , 'DepartmentController');
	Route::get('/maintenancestats' , ['uses' => 'MaintenanceController@statistics' , 'as' => 'maintenancestats']);
	Route::get('/maintenancepdf' , ['uses' => 'MaintenanceController@maintenance' , 'as' => 'maintenancepdf']);
	Route::resource('/maintenance' , 'MaintenanceController');
	Route::post('/secretary/{id}' , 'MeetingController@secretary');
	Route::post('/attendance' , ['uses' =>'MemberController@attendance' , 'as' =>'attendance'] );
	Route::post('/minutes' , ['uses' =>'MemberController@attendance' , 'as' =>'minutes'] );
	Route::resource('/meeting' , 'MeetingController');
	Route::resource('/member' , 'MemberController');
	Route::resource('/minute' , 'MinuteController');
	Route::get('/hospitalinvoice/{id}' , ['uses' => 'HealthChargeController@invoice', 'as' => 'hospitalinvoice']);
	Route::get('/hospitalpdf' , ['uses' => 'HealthChargeController@healthpdf', 'as' => 'healthpdf']);
	Route::get('/hospitalstatistics' , ['uses' => 'HealthChargeController@statistics' , 'as' => 'healthstatistics']);
	Route::resource('/healthcharge' , 'HealthChargeController');
	Route::resource('healthservice' , 'HealthServiceController');
	Route::resource('/finance' , 'FinanceController');
	Route::post('/transportofficial/{id}' , ['uses' => 'TransportController@official' , 'as' => 'officialtransport']);
	Route::get('/transportinvoice/{id}' , ['uses' => 'TransportController@invoice' , 'as' => 'transportinvoice']);
	Route::get('/transportreport' , ['uses' => 'TransportController@report' , 'as' => 'transportpdf']);
	Route::get('/transportstats' , ['uses' => 'TransportController@statistics' , 'as' => 'transportstats']);
	Route::get('/transporthome' , ['uses' => 'TransportController@home' , 'as' => 'transporthome']);
	Route::resource('/transport' , 'TransportController');
	Route::post('/purchasereciept' , ['uses' => 'PurchaseController@reciept' , 'as' => 'purchasereciept']);
	Route::get('/purchasepdf' , ['uses' => 'PurchaseController@report', 'as' => 'purchasepdf']);
	Route::get('/purchasestats' , ['uses' => 'PurchaseController@statistics', 'as' => 'purchasestats']);
	Route::resource('/purchase' , 'PurchaseController');
	Route::get('/leavepdf' , ['uses' => 'LeaveController@report' , 'as' => 'leavepdf']);
	Route::get('/leavestats' , ['uses' => 'LeaveController@statistics' , 'as' => 'leavestats']);
	Route::resource('/leave' , 'LeaveController');
	Route::resource('/announcement', 'AnnouncementController');
	Route::get('/memoreceipient/{memoid}', ['uses' => 'MemoController@receipient', 'as' => 'memoreceipient']);
	Route::post('/storereceipient', ['uses' => 'MemoController@storeReceipient', 'as' => 'storereceipient']);
	Route::get('/memopdf/{id}', ['uses' => 'MemoController@pdf', 'as' => 'memopdf']);
	Route::resource('/memo', 'MemoController');
	Route::resource('messages' , "MessagesController");
});


/*
Route::get('ID/{id}', function($id){
	echo 'ID:' .$id; 	
});

Route::get('user/{user?}', function($user = 'wapnen gowok'){
	echo 'User: ' .$user;
});

Route::get('role', [
	'middleware'=> 'Role:editor', 
	'uses' => 'TestController@index', 
	]);
	*/