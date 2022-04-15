<?php

use BulveyzRouter\Route;

Route::setNamespace('Aliakbar\UrlShortener\Controllers');


Route::get('/', 'HomeController@index')->name('index');
Route::get('/logout', 'HomeController@logout')->name('logout');

//Dashboard routes
Route::get('/dashboard/links', 'Dashboard\LinkController@index')->name('dashboard.links.index');

//Auth Login routes url
Route::get('/login', 'Auth\LoginController@index')->name('auth.index');
Route::post('/auth/login', 'Auth\LoginController@login')->name('auth.login');
