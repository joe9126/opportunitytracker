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

Route::get('/','AuthController@index');
Route::get('login','AuthController@index');
Route::post('post-login','AuthController@postLogin');
Route::get('registration','AuthController@registration');
Route::post('post-registration','AuthController@postRegistration');
Route::get('dashboard','AuthController@dashboard');
Route::get('logout','AuthController@logout');
Route::get('getstaffs','AuthController@create');
Route::get('searchstaff/{id}','AuthController@searchstaff');
Route::post("edituser",'AuthController@edit');

Route::get('opportunities','OpportunityController@index');
Route::post('opportunities','OpportunityController@store');
Route::get('opportunities/create','OpportunityController@create');
Route::get("opportunities/summary","OpportunityController@getsummary");
Route::post("opportunities/update/{id}","OpportunityController@update");

Route::post("updatestage/{id}","OpportunityController@edit");

Route::post('opportunities/addtrail','TrailController@store');
Route::get('opportunities/show/{id}','TrailController@show');
Route::post('trail/destroy/{id}','TrailController@destroy');


Route::get('clients/show/{id}','ClientsController@show');
Route::get('clients/create','ClientsController@create');

Route::get('manageaccounts','AuthController@registration');
Route::post('createuser','AuthController@postRegistration');
Route::post('deleteopportunity','OpportunityController@delete');
