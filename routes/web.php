<?php

use BulveyzRouter\Route;

Route::setNamespace('Aliakbar\UrlShortener\Controllers');


Route::get('/', 'HomeController@index')->name('index');
Route::get('/{code}', 'HomeController@getShortURL')->name('shorturl');
Route::get('/logout', 'HomeController@logout')->name('logout');

//Dashboard routes
Route::get('/dashboard/links', 'Dashboard\LinkController@index')->name('dashboard.links.index');
Route::get('/dashboard/links/delete/{id}', 'Dashboard\LinkController@delete')->name('dashboard.links.delete');
Route::post('/dashboard/links/store', 'Dashboard\LinkController@store')->name('dashboard.links.store');
//Auth Login routes url
Route::get('/login', 'Auth\LoginController@index')->name('auth.index');
Route::post('/auth/login', 'Auth\LoginController@login')->name('auth.login');



//api
Route::post('/api/login', 'Api\Auth\LoginController@login');

Route::get('/api/links', 'Api\Link\LinkController@index');
Route::post('/api/links', 'Api\Link\LinkController@store');
//PUT
Route::post('/api/links/update/{id}', 'Api\Link\LinkController@update');
//DELETE
Route::post('/api/links/delete/{id}', 'Api\Link\LinkController@delete');
