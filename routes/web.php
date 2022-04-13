<?php

use BulveyzRouter\Route;

Route::setNamespace('Aliakbar\UrlShortener\Controllers');

//Dashboard routes
Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard.index');

//Auth Login routes url
Route::get('/login', 'Auth\LoginController@index')->name('login.index');
