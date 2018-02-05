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
//PAge d'accueil
Route::get('/', 'Frontcontroller@index')->name('home');

//Route pour l'affichage d'une formation/stage
Route::get('post/{id}', 'FrontController@show')->name('show');

//Route pour les categories
Route::get('category/{id}', 'FrontController@showBookByCategory')->name('category');