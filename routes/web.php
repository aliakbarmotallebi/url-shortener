<?php

use BulveyzRouter\Route;

Route::setNamespace('Aliakbar\UrlShortener\Controllers');

//Dashboard routes
Route::get('/dashboard/links', 'Dashboard\LinkController@index')->name('dashboard.links.index');

//Auth Login routes url
Route::get('/login', 'Auth\LoginController@index')->name('login.index');
Route::post('/auth/login', 'Auth\LoginController@login')->name('auth.login');
