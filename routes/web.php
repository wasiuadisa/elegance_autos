<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!|
*/

#####################################################
####### These are routes for the public pages #######
#####################################################
// Route to the public Home or landing page 
Route::redirect('/', 'web')->name('landingPageRedirect');

// Home or landing page
Route::get('/web', 'PublicController@index')->name('landingPage');

// About us page
Route::get('/about-us', 'PublicController@about')->name('publicAbout');

// In stock page
Route::get('/in-stock', 'PublicController@instock')->name('publicInstock');

// News page
Route::get('/news', 'PublicController@news')->name('publicNews');

// Contact us page form
Route::get('/contact-us', 'PublicController@contact')->name('publicContact');
// Routes to creating a new Contact us page message in the database
Route::post('/contact-us', 'PublicController@contactPost')->name('publicContactData');

// This is the collection of Authentication routes
//Auth::routes();
Auth::routes(['register' => false]);//Register route deactivated

// Admin Dashboard from out
Route::get('/home', 'HomeController@index')->name('AdminIndex');//Former route('home')

/*|----------------------------------------------
|## Routes groups for AdminArea pages ##
|----------------------------------------------*/
Route::prefix('AdminArea')->group(function () {

	// Admin Dashboard
	Route::redirect('/', 'home')->name('homeRedirect');

	// Admin Dashboard
	Route::get('/home', 'HomeController@index')->name('home');

	#####################################################
	####### These are routes for the page tests #########
	#####################################################
	// Admin Template
	Route::get('Template', 'AdminController@template')->name('template');

	// Admin Dashboard
	Route::get('Testing', 'AdminController@test')->name('test');


	#####################################################
	######### These are routes for car types ############
	#####################################################
	// List of car types
	Route::get('Types', 'Admin\TypesController@types')->name('types');

	// Routes to form for creating a new vehicle type/genres
	Route::get('NewType', 'Admin\TypesController@newCarTypeForm')->name('newCarTypeForm');

	// Routes to creating a new vehicle type/genres in the database
	Route::post('NewType', 'Admin\TypesController@newCarTypeFormPost')->name('newCarTypeFormData');

	// Routes to form for editing an existing vehicle type/genres post
	Route::get('EditVehicleType/{id}', 'Admin\TypesController@editCarTypeForm')->name('editCarTypeForm');

	// Routes to editing an existing vehicle type/genres in the database
	Route::post('EditVehicleType/{id}', 'Admin\TypesController@editCarTypeFormPost')->name('editCarTypeFormData');

	//Delete a vehicle type/genres
	Route::get('TypeOut/{id}', 'Admin\TypesController@typeDelete')->name('typeDelete');


	#####################################################
	######### These are routes for car brands ###########
	#####################################################
	// List of car brands
	Route::get('Brands', 'Admin\BrandsController@brands')->name('brands');

	// Routes to form for creating a new vehicle brand
	Route::get('NewBrand', 'Admin\BrandsController@newCarBrandForm')->name('newCarBrandForm');

	// Routes to creating a new vehicle brand in the database
	Route::post('NewBrand', 'Admin\BrandsController@newCarBrandFormPost')->name('newCarBrandFormData');

	// Routes to form for editing an existing vehicle brands post
	Route::get('EditVehicleBrand/{id}', 'Admin\BrandsController@editCarBrandForm')->name('editCarBrandForm');

	// Routes to editing an existing vehicle brands in the database
	Route::post('EditVehicleBrand/{id}', 'Admin\BrandsController@editCarBrandFormPost')->name('editCarBrandFormData');

	//Delete a vehicle type/genres
	Route::get('BrandOut/{id}', 'Admin\BrandsController@brandDelete')->name('brandDelete');


	#####################################################
	#### These are routes for car posts and images ######
	#####################################################
	// Routes for creating a new vehicle post
	Route::get('NewVehicle', 'Admin\CarsController@newCarForm')->name('newCarForm');
	Route::post('NewVehicle', 'Admin\CarsController@newCarFormPost')->name('newCarFormData');

	// Routes for creating a new vehicle image
	Route::get('NewVehicleImage/{id}', 'Admin\CarsController@newCarImageForm')->name('newCarImageForm')->where(['id' => '[0-9]+']);
	Route::post('NewVehicleImage', 'Admin\CarsController@newCarImageFormPost')->name('newCarImageFormData');

	// Routes for editing an existing vehicle post
	Route::get('EditVehicle/{id}', 'Admin\CarsController@editCarForm')->name('editCarForm');
	Route::post('EditVehicle/{id}', 'Admin\CarsController@editCarFormPost')->name('editCarFormData');

	// Routes for editing an existing vehicle image
	Route::get('EditVehicleImage/{ImageId}', 'Admin\CarsController@editCarImageForm')->name('editCarImageForm')->where(['ImageId' => '[0-9]+']);
	Route::post('EditVehicleImage/{ImageId}', 'Admin\CarsController@editCarImageFormPost')->name('editCarImageFormData');

	// Delete a vehicle's image or mark it as deleted
	Route::get('ImageOut/{ImageId}/{PostId}', 'Admin\CarsController@imageDelete')->name('deleteImage');

	// Delete a vehicle's image or mark it as deleted
	Route::get('ImageOut2/{ImageId}/{PostId}', 'Admin\CarsController@imageDelete2')->name('deleteImage2');

	// List of cars
	Route::get('Solds', 'Admin\CarsController@solds')->name('soldCars');

	// List of cars
	Route::get('Vehicles', 'Admin\CarsController@posts')->name('posts');

	// List of used cars
	Route::get('UsedCars', 'Admin\CarsController@usedCars')->name('usedCars');

	// List of new cars
	Route::get('NewCars', 'Admin\CarsController@newCars')->name('newCars');

	// List of car categories by name
	Route::get('Category/{categoryName}', 'Admin\CarsController@categoryList2')->name('categoryList');
/*
	// List of car categories by name
	Route::get('Category/{categoryName}', 'Admin\CarsController@categoryList')->name('categoryList');
*/
	// View a vehicle post
	Route::get('View/{id}', 'Admin\CarsController@viewPost')->name('postView');

	// Mark a vehicle as sold
	Route::get('Sold/{id}/{returnPath}', 'Admin\CarsController@postSold')->name('postSold');

	// Mark a vehicle as sold
	Route::get('Sold/{id}', 'Admin\CarsController@postSold2')->name('postSold2');

	// Mark a vehicle as deleted
	Route::get('Out/{id}/{ReturnPath}', 'Admin\CarsController@postDelete')->name('postDelete');

	// Mark a vehicle in Category list as sold
	Route::get('Sold/{id}/categoryList/{categoryName}', 'Admin\CarsController@postSoldForCategories')->name('postSoldForCategories');

	// Mark a vehicle in Category list as deleted
	Route::get('Out/{id}/categoryList/{categoryName}', 'Admin\CarsController@postDeleteForCategories')->name('postDeleteForCategories');

	// Images list
	Route::get('Images', 'Admin\CarsController@images')->name('images');


	#####################################################
	#### These are routes for event posts and images ######
	#####################################################
	// Routes for creating a new event post
	Route::get('NewEvent', 'Admin\EventsController@newEventForm')->name('newEventForm');
	Route::post('NewEvent', 'Admin\EventsController@newEventFormPost')->name('newEventFormData');

	// Routes for creating an new event image
	Route::get('NewEventImage/{id}', 'Admin\EventsController@newEventImageForm')->name('newEventImageForm')->where(['id' => '[0-9]+']);
	Route::post('NewEventImage', 'Admin\EventsController@newEventImageFormPost')->name('newEventImageFormData');

	// Routes for editing an existing event
	Route::get('EditEvent/{id}', 'Admin\EventsController@editEventForm')->name('editEventForm');
	Route::post('EditEvent/{id}', 'Admin\EventsController@editEventFormPost')->name('editEventFormData');

	// Routes for editing an existing event image
	Route::get('EditEventImage/{ImageId}', 'Admin\EventsController@editEventImageForm')->name('editEventImageForm')->where(['ImageId' => '[0-9]+']);
	Route::post('EditEventImage/{ImageId}', 'Admin\EventsController@editEventImageFormPost')->name('editEventImageFormData');

	// Delete a event's image or mark it as deleted
	Route::get('EventImageOut/{ImageId}/{EventId}', 'Admin\EventsController@eventImageDelete')->name('deleteEventImage');

	// Delete an event's image or mark it as deleted
	Route::get('EventImageOut2/{ImageId}/{EventId}', 'Admin\EventsController@eventImageDelete2')->name('deleteEventImage2');

	// List of events
	Route::get('Events', 'Admin\EventsController@index')->name('events');

	// View an event
	Route::get('EventsView/{id}', 'Admin\EventsController@viewEvent')->name('eventView');
/*
	// Mark an event as blocked
	Route::get('EventsSanction/{id}/{ReturnPath}', 'Admin\EventsController@eventBlock')->name('eventBlock');

	// Mark an event as Unblocked
	Route::get('EventsUnSanction/{id}/{ReturnPath}', 'Admin\EventsController@eventUnBlock')->name('eventUnBlock');
*/
	// Delete an event
	Route::get('EventsOut/{id}/{ReturnPath}', 'Admin\EventsController@eventDelete')->name('eventDelete');
});

