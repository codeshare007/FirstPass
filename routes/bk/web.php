<?php
use Illuminate\Support\Facades\Route;

Route::get('/get_model', 'GuestController@get_model');
Route::post('/load_events', 'GuestController@load_events');

Route::get('/{id?}', 'GuestController@index')->where('id', '[0-9]+');
Route::get('driving-lessons/test-package', 'GuestController@test_package');
Route::get('/contact', 'GuestController@contact');
Route::post('/save-contact-form', 'GuestController@save_contact_form')->name('save-contact-form');
Route::get('/autocomplete-regions', 'GuestController@autocomplete_regions_ajax');
Route::post('/search/{id?}', 'GuestController@search')->name('search');

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
Route::post('/register_learner', 'GuestController@register_learner')->name('register_learner');

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/instructor/request', 'HomeController@instructorRequest');

/*Auth Routes*/
Route::group(['middleware' => ['auth']], function(){
    Route::post('/stripe-payment', 'GuestController@strip_payment')->name('strip_payment');
});

/*auth + email verified*/
Route::group(['middleware' => ['auth', 'verified']], function(){

    Route::resource('settings', 'SettingsController');

    /* Connected Account routes*/
    Route::get('/redirect_url', 'SettingsController@redirect_url')->name('redirect_url');

    Route::resource('appointments', 'AppointmentController');
    Route::get('/get-appointments', 'AppointmentController@get_appointments')->name('get-appointments');
    Route::post('/update-appointment-status', 'AppointmentController@update_appointment_status')->name('update-appointment-status');
    Route::post('/get-appointment-detail', 'AppointmentController@get_appointment_details')->name('get-appointment-detail');
    Route::post('/withdraw-amount', 'AppointmentController@withdraw_amount')->name('withdraw-amount');

    /* Learner Routes*/
    Route::resource('lessons', 'LessonController');
    Route::get('/get-lessons', 'LessonController@get_lessons')->name('get-lessons');
    Route::post('/Update-book-time', 'LessonController@update_book_time')->name('Update-book-time');
    Route::post('/Change-appointment-status', 'LessonController@change_appointment_status')->name('Change-appointment-status');

    Route::get('profile', 'UserController@profile')->name('profile');
    Route::post('save-profile', 'UserController@saveProfile')->name('save-profile');
    Route::post('/update-status', 'UserController@update_status')->name('update-status');

    Route::get('/instructor-details/{id}', 'UserController@instructor_details');
    /*instructor*/
    Route::get('profile-and-vehicle', 'InstructorController@profile_vehicle')->name('profile/vehicle');
    Route::get('services-and-availability', 'InstructorController@services_availability')->name('services_availability');
    Route::post('save-instructor-vehicle', 'InstructorController@save_instructor_vehicle')->name('save_instructor_vehicle');

    Route::get('instructor-map-suburb', 'InstructorController@instructor_map_suburb')->name('instructor_map_suburb');
    Route::post('save-service-regions', 'InstructorController@save_service_regions')->name('save_service_regions');

    Route::get('my-documents', 'InstructorController@my_documents')->name('my_documents');
    Route::post('save-my-documents', 'InstructorController@save_my_documents')->name('save_my_documents');

    Route::post('get-vehicle-model', 'InstructorController@get_vehicle_model')->name('get_vehicle_model');
    Route::post('get_instructor_calendar', 'InstructorController@get_instructor_calendar');

    Route::post('get-review', 'InstructorController@get_review')->name('get_review');
    Route::post('give-review', 'InstructorController@save_review')->name('give_review');
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

    Route::get('/email-settings', 'AdminController@email_settings')->name('email_settings');
    Route::post('/save-emails', 'AdminController@save')->name('save-emails');
    Route::post('/store-mailing', 'AdminController@storeMailing')->name('store-mailing');
    Route::post('/mail-send-test', 'AdminController@mailSendTest')->name('mail-send-test');
    Route::post('/document-status', 'AdminController@document_status')->name('document_status');

    /* Twilio Routes */
    Route::resource('/twilio', 'TwilioController');
});
