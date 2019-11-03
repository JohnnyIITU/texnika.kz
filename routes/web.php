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
Route::post('/sale/getConditionOptions', 'SaleController@getConditionOptions');
Route::post('/sale/getObjects', 'SaleController@getObjects');


Route::get('/service/create', 'ServiceController@create');
Route::get('/service/view/{id}', 'ServiceController@view');
Route::get('/service/', 'ServiceController@index');
Route::post('/service/save', 'ServiceController@save');
Route::post('/service/saveToTrash', 'ServiceController@saveToTrash');

Route::get('/test', function (){
    dd((new \App\Sale())->getConditionOptions());
});

Route::get('/testAuth', function (){
    dd(Auth::check());
});

Route::get('mark', function (){
    return view('addmark');
});

Route::post('mark', function(){
    $mark = $_POST['mark'];
    $model = new \App\Mark();
    $model->value = $mark;
    $model->save();
});