<?php

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

Route::get('/', 'PublicController@index');

Auth::routes();

Route::get('/password/reset-pass', function () {
    return view('reset');
});
Route::post('/password/change', 'ProfileController@changePassword');
Route::get('/public/blood-donors', 'PublicController@searchDonorsData');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index');
Route::get('/profile/edit', 'ProfileController@addBloodDetail');
Route::post('/profile/edit', 'ProfileController@addBloodDetail');
Route::get('/admin/view-users', 'AdminController@index');
Route::post('/admin/status-change/{id}', 'AdminController@statusChange');
Route::post('/admin/user-delete/{id}', 'AdminController@deleteUser');
Route::get('/admin/add-donor', 'AdminController@addDonors');
Route::get('/admin/download-csv', 'AdminController@downloadCsvFile');
Route::post('/admin/donors-data-add', 'AdminController@addDonorsData');
Route::post('/admin/donors-csv-add', 'AdminController@addDonorsDataFromCSV');
Route::post('/get-state', 'PublicController@StateonCitySelect');
Route::post('/get-city', 'PublicController@CityonStateSelect');
Route::post('/get-all-city-state', 'PublicController@getAllCityStates');
