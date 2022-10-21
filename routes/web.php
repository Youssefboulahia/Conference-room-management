<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/team/home','TeamController@home')->name('team.home');
Route::get('/team/about-us','TeamController@about')->name('team.about');
Route::get('/team/courses','TeamController@courses')->name('team.courses');
Route::get('/team/contact','TeamController@contact')->name('team.contact');


Route::get('/','MainController@home')->name('home.main');
Route::get('/home','MainController@home')->name('home.main');
Route::get('/services','MainController@service')->name('service');
Route::get('/about_us','MainController@about')->name('about');
Route::get('/events','MainController@event')->name('event');
Route::get('/training','MainController@training')->name('training');
Route::get('/contact','MainController@contact')->name('contact');
Route::get('/innovations','MainController@innovation')->name('innovation');
Route::post('/contact/send','MainController@contact_send')->name('contact.send');
Route::get('/email','MainController@emailLogin')->name('email');
Route::post('/email','MainController@emailCheck')->name('email.check');
Route::get('/email/view','MainController@emailView')->name('email.view');




Route::get('room_booking_system/', 'DashboardController@roomBooking')->name('roomBooking');

// Authentication Routes...
Route::get('room_booking_system/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('room_booking_system/login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::resource('profile', 'ProfileController')->middleware('auth');

Route::get('room', 'DashboardController@start')->name('home')->middleware('auth','secretary');
Route::post('room/store', 'DashboardController@roomStore')->name('room.store')->middleware('auth','secretary');
Route::post('room/delete', 'DashboardController@roomDelete')->name('room.delete')->middleware('auth','secretary');
Route::post('room/update', 'DashboardController@roomUpdate')->name('room.update')->middleware('auth','secretary');

Route::get('reservation', 'DashboardController@reservation')->name('reservation')->middleware('auth');
Route::post('reservation/store', 'DashboardController@reservationStore')->name('reservation.store')->middleware('auth');
Route::post('reservation/delete', 'DashboardController@reservationDelete')->name('reservation.delete')->middleware('auth');
Route::get('reservation/filter', 'DashboardController@reservationFilter')->name('reservation.filter')->middleware('auth');

Route::get('calandar', 'DashboardController@calandar')->name('calandar')->middleware('auth');
Route::get('calandar/room/{id}', 'DashboardController@calandarRoom')->name('calandar.room')->middleware('auth');


Route::get('/allDataAgenda', 'CalandarController@getData');

Route::get('manage_users', 'DashboardController@gererUser')->name('user.show')->middleware('auth','secretary');
Route::get('manage_users/add', 'DashboardController@gererUserAdd')->name('user.add')->middleware('auth','secretary');
Route::post('manage_users/store', 'DashboardController@gererUserStore')->name('user.store')->middleware('auth','secretary');
Route::post('manage_users/delete', 'DashboardController@gererUserDelete')->name('user.delete')->middleware('auth','secretary');




