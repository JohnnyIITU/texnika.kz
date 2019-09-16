<?php

Route::get('/', 'SiteController@index');

Route::post('/checkUsername', 'LoginController@checkUsername');

Route::post('/register', 'LoginController@register');

Route::post('/login', 'LoginController@login');

Route::get('logout', function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/');
});

Route::post('getCityList', 'SiteController@getCityList');
Route::post('getTypeList', 'SiteController@getTypeList');
Route::post('getMarkList', 'SiteController@getMarkList');
Route::post('getServiceTypeList', 'SiteController@getServiceTypeList');
Route::post('getYearList', 'SiteController@getYearList');


Route::get('/rent/create', 'RentController@create');
Route::get('/rent/view/{id}', 'RentController@view');
Route::get('/rent/', 'RentController@index');
Route::post('/rent/save', 'RentController@save');
Route::post('/rent/saveToTrash', 'RentController@saveToTrash');
Route::post('/rent/getObjects', 'RentController@getObjects');

Route::get('/sale/create', 'SaleController@create');
Route::get('/sale/view/{id}', 'SaleController@view');
Route::get('/sale/', 'SaleController@index');
Route::post('/sale/save', 'SaleController@save');
Route::post('/sale/saveToTrash', 'SaleController@saveToTrash');

Route::get('/service/create', 'ServiceController@create');
Route::get('/service/view/{id}', 'ServiceController@view');
Route::get('/service/', 'ServiceController@index');
Route::post('/service/save', 'ServiceController@save');
Route::post('/service/saveToTrash', 'ServiceController@saveToTrash');

Route::get('/test', 'SaleController@test');