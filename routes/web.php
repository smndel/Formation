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



//Page d'accueil
Route::get('/', 'Frontcontroller@index')->name('index');

//Route pour l'affichage d'une formation/stage
Route::get('post/{id}', 'FrontController@show')->name('show');

//Route pour les categories
Route::get('type/{type}', 'FrontController@showPostByType')->name('type');

//Route pour la page contact
Route::get('contact', 'ContactController@show')->name('contact');
Route::post('contact',  'ContactController@mailToAdmin'); 

//Route pour la barre de recherche:
Route::any('search', 'FrontController@search')->name('search');

//routes sécurisées
Route::resource('admin/post', 'PostController')->middleware('auth');

//Route pour DeleteAll sur le dashboard Back:
Route::delete('myproductsDeleteAll', 'Postcontroller@deleteAll')->name('deleteAll');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
