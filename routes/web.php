<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/get_model', 'GuestController@get_model');
Route::post('/load_events', 'GuestController@load_events');

Route::get('/{id?}', 'GuestController@index')->where('id', '[0-9]+');
Route::get('driving-lessons/test-package', 'GuestController@test_package');
Route::get('/contact', 'GuestController@contact');
Route::post('/save-contact-form', 'GuestController@save_contact_form')->name('save-contact-form');
Route::get('/autocomplete-regions', 'GuestController@autocomplete_regions_ajax');
Route::get('/autocomplete-test-locations', 'GuestController@autocomplete_test_locations_ajax');

Route::post('/search/{id?}', 'GuestController@search')->name('search');
Route::post('/search-filter/{search_id}', 'GuestController@searchFilter')->name('search-filter');

Route::get('/instructors/search_id/{id?}', 'GuestController@searchInstructors')->name('instructors.search');
//bilal
Route::post('/update_user_region', 'RegionController@update_user_region')->name('update_user_region');
//
Route::get('instructor-map-suburb', 'InstructorController@instructor_map_suburb')->name('instructor_map_suburb');
Route::get('/get-test-location', 'GuestController@get_test_location')->name('test_location');


Route::get('/search/instructors/all', 'GuestController@view_instructors');

Route::get('/search/instructors/{id?}', 'GuestController@view_instructors')
    ->where('id', '[0-9]+');

Route::post('/create-search-from-learner', 'GuestController@create_search_from_learner');

Route::get('/search/{search_id}/instructors/profile/{profile_id}', 'GuestController@instructor_profile')
    ->where('search_id', '[0-9]+')->where('profile_id', '[0-9]+');

Route::get('/book-online/{search_id}/instructor/{instructor_id}', 'GuestController@book_online')
    ->where('search_id', '[0-9]+')->where('instructor_id', '[0-9]+');

Route::get('/book-online/cart/{search_id}/instructor/{instructor_id}', 'GuestController@book_online_cart')
    ->where('search_id', '[0-9]+')->where('instructor_id', '[0-9]+');

Route::get('/book-online/book/{search_id}/instructor/{instructor_id}', 'GuestController@book_online_book')
    ->where('search_id', '[0-9]+')->where('instructor_id', '[0-9]+');

Route::get('/learners/register/{search_id}', 'GuestController@learner_register')
    ->where('search_id', '[0-9]+');

Route::get('/learners/payment/{search_id}', 'GuestController@learner_payment')
    ->where('search_id', '[0-9]+');


Route::post('/get-slots', 'GuestController@get_slots');
Route::post('/get-slots1', 'GuestController@get_slots1');
Route::post('/register_learner', 'GuestController@register_learner')->name('register_learner');


Route::post('/register_inst', 'GuestController@register_inst')->name('register_inst');

Auth::routes();

Route::get('/instructor/request', 'HomeController@instructorRequest');
Route::get('get-review-pages', 'HomeController@get_review_pages')->name('get_review_pages');


/*Auth Routes*/
Route::group(['middleware' => ['auth']], function(){
    Route::post('/appointment-request', 'GuestController@process_appointment')->name('stripe_payment');
});

/*auth + email verified*/
Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('settings', 'SettingsController');
    Route::get('settings-twilio', 'SettingsController@twiliosetting')->name('twiliosettings');

    Route::get('back-to-admin', 'UserController@back_to_admin')->name('back_to_admin');
    /* Connected Account routes*/
    Route::get('/redirect_url', 'SettingsController@redirect_url')->name('redirect_url');

    Route::resource('appointments', 'AppointmentController');
    Route::get('/get-appointments', 'AppointmentController@get_appointments')->name('get-appointments');
    Route::post('/update-appointment-status', 'AppointmentController@update_appointment_status')->name('update-appointment-status');

    Route::post('/get-appointment-detail', 'AppointmentController@get_appointment_details')->name('get-appointment-detail');
    Route::post('/withdraw-amount', 'AppointmentController@withdraw_amount')->name('withdraw-amount');

    Route::post('/get-appointment-detail-inst', 'AppointmentController@get_appointment_details_inst')->name('get-appointment-detail-inst');

    /* Learner Routes*/
    Route::resource('lessons', 'LessonController');
    Route::get('/get-lessons', 'LessonController@get_lessons')->name('get-lessons');
    Route::post('/Update-book-time', 'LessonController@update_book_time')->name('Update-book-time');
    Route::post('/Change-appointment-status', 'LessonController@change_appointment_status')->name('Change-appointment-status');

    Route::get('/learner/faqs', 'LessonController@faq')->name('learner.faqs');
    Route::get('/learner/purchases', 'LessonController@purchases')->name('learner.purchases');

    Route::get('profile', 'UserController@profile')->name('profile');
    Route::post('save-profile', 'UserController@saveProfile')->name('save-profile');
    Route::post('/update-status', 'UserController@update_status')->name('update-status');
    Route::post('update_profile_img', 'UserController@update_profile_img')->name('update_profile_img');

    Route::get('/instructor-details/{id}/{notify_type?}', 'UserController@instructor_details');
    Route::post('/instructor-details/{id}', 'UserController@save_image')->name('save-image');
    Route::post('update_vehicle_img', 'UserController@update_vehicle_img')->name('update_vehicle_img');
    Route::post('update_wwcc_img', 'UserController@update_wwcc_img')->name('update_wwcc_img');

    Route::post('update_vehicle_status', 'UserController@update_vehicle_status')->name('update_vehicle_status');

    /*instructor*/
    Route::get('profile-and-vehicle', 'InstructorController@profile_vehicle')->name('profile/vehicle');
    Route::get('services-and-availability', 'InstructorController@services_availability')->name('services_availability');
    Route::post('save-instructor-vehicle', 'InstructorController@save_instructor_vehicle')->name('save_instructor_vehicle');

    Route::post('save-service-regions', 'InstructorController@save_service_regions')->name('save_service_regions');

    Route::get('my-documents', 'InstructorController@my_documents')->name('my_documents');
    Route::post('save-my-documents', 'InstructorController@save_my_documents')->name('save_my_documents');

    Route::post('get-vehicle-model', 'InstructorController@get_vehicle_model')->name('get_vehicle_model');
    Route::post('get-vehicle-year', 'InstructorController@get_vehicle_year')->name('get_vehicle_year');
    Route::post('get-vehicle-model-img', 'InstructorController@get_vehicle_model_img')->name('get_vehicle_model_img');

    Route::post('get_instructor_calendar', 'InstructorController@get_instructor_calendar');

    Route::post('get-review', 'InstructorController@get_review')->name('get_review');
    Route::post('give-review', 'InstructorController@save_review')->name('give_review');

    Route::get('instructor/calendar', 'InstructorController@view_calendar')->name('instructor_calendar');
    Route::post('add_event', 'InstructorController@addEvent');
    Route::post('show-event', 'InstructorController@showEvent');
    Route::post('delete-event', 'InstructorController@deleteEvent');

    Route::get('/instructor/notifications', 'InstructorController@notifications')->name('instructor.notifications');
    Route::get('/instructor/get_notifications', 'InstructorController@getNotifications')->name('instructor.get_notifications');
    Route::get('/instructor/view-notification/{id}', 'InstructorController@viewNotification')->name('instructor.view_notification');

});

/*Admin Only*/
Route::group(['middleware' => ['auth', 'verified', 'admin']], function(){
    Route::resource('/user', 'UserController');
    Route::post('user-login', 'UserController@userLogin')->name('user-login');

    Route::get('/users', 'UserController@view_users')->name('users');
    Route::get('/get-users', 'UserController@get_users')->name('get-users');
    Route::post('/delete-user', 'UserController@delete_user')->name('delete-user');

    Route::get('/regions', 'RegionController@index');
    Route::get('/get_regions', 'RegionController@get_regions')->name('get-regions');
    Route::post('edit-region', 'RegionController@edit_region')->name('edit-region');
    Route::post('save-region', 'RegionController@save_region')->name('save-region');

    Route::get('test-package', 'TestPackageController@index')->name('test-package');
    Route::post('save-test-package', 'TestPackageController@save_test_package')->name('save-test-package');

    Route::get('/cars', 'CarController@index');
    Route::get('/get_cars', 'CarController@get_cars')->name('get-cars');
    Route::post('edit-car', 'CarController@edit_car')->name('edit-car');
    Route::post('save-car', 'CarController@save_car')->name('save-car');
    Route::post('add-car', 'CarController@add_car')->name('add-car');
    Route::post('delete-car', 'CarController@delete_car')->name('delete-car');

    Route::get('/models/{id}', 'ModelController@index');
    Route::get('/get_cars/{id}/getmodels', 'ModelController@get_models')->name('get-models');
    Route::post('edit-model', 'ModelController@edit_model')->name('edit-model');
    Route::post('save-model', 'ModelController@save_model')->name('save-model');
    Route::post('add-model', 'ModelController@add_model')->name('add-model');
    Route::post('delete-model', 'ModelController@delete_model')->name('delete-model');

    Route::get('/years/{id}', 'YearController@index');
    Route::get('/get_cars/{id}/getyears', 'YearController@get_years')->name('get-years');
    Route::post('edit-year', 'YearController@edit_year')->name('edit-year');
    Route::post('save-year', 'YearController@save_year')->name('save-year');
    Route::post('add-year', 'YearController@add_year')->name('add-year');
    Route::post('delete-year', 'YearController@delete_year')->name('delete-year');

    Route::get('/email-settings', 'AdminController@email_settings')->name('email_settings');
    Route::post('/save-emails', 'AdminController@save')->name('save-emails');
    Route::post('/store-mailing', 'AdminController@storeMailing')->name('store-mailing');
    Route::post('/mail-send-test', 'AdminController@mailSendTest')->name('mail-send-test');
    Route::post('/document-status', 'AdminController@document_status')->name('document_status');

    /* Twilio Routes */
    Route::resource('/twilio', 'TwilioController');

    /* Notifications */
    Route::get('/notifications', 'NotificationsController@index')->name('notifications');
    Route::get('/get_notifications', 'NotificationsController@get_notifications')->name('get_notifications');
    Route::get('/view_notification/{id}', 'NotificationsController@view_notification')->name('view_notification');
});
