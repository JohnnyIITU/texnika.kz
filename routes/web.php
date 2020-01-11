<?php
Route::group(['domain' => env('BACKEND_DOMAIN', 'admin.texnika.kz')], function () {
    Route::get('/', 'Admin\SiteController@showLoginForm');
    Route::post('/login', 'Admin\SiteController@login');

    Route::get('index', 'Admin\SiteController@index');

    Route::get('marks', 'Admin\SiteController@marks')->name('marks');
    Route::post('/marks/getList', 'Admin\SiteController@getMarks');
    Route::get('/marks/add', 'Admin\SiteController@addMarkView');
    Route::post('/marks/add', 'Admin\SiteController@addMark');
    Route::post('/marks/delete', 'Admin\SiteController@deleteMark');


    Route::get('cities', 'Admin\SiteController@cities')->name('cities');
    Route::post('/cities/getList', 'Admin\SiteController@getCities');
    Route::get('/cities/add', 'Admin\SiteController@addCityView');
    Route::post('/cities/add', 'Admin\SiteController@addCity');
    Route::post('/cities/delete', 'Admin\SiteController@deleteCity');

    Route::get('equipments', 'Admin\SiteController@equipment')->name('equipments');
    Route::post('/equipments/getList', 'Admin\SiteController@getEquipments');
    Route::get('/equipments/add', 'Admin\SiteController@addEquipmentView');
    Route::post('/equipments/add', 'Admin\SiteController@addEquipment');
    Route::post('/equipments/delete', 'Admin\SiteController@deleteEquipment');

    Route::get('services', 'Admin\SiteController@services')->name('services');
    Route::post('/services/getList', 'Admin\SiteController@getServices');
    Route::get('/services/add', 'Admin\SiteController@addServiceView');
    Route::post('/services/add', 'Admin\SiteController@addService');
    Route::post('/services/delete', 'Admin\SiteController@deleteService');



    Route::get('users', 'Admin\SiteController@users')->name('users');
    Route::post('users/getList', 'Admin\SiteController@getUsers');

    Route::get('rents', 'Admin\SiteController@rents')->name('rents');
    Route::post('rents/getList', 'Admin\SiteController@getRents');
    Route::post('rents/delete', 'Admin\SiteController@deleteRent');
    Route::get('sales', 'Admin\SiteController@sales')->name('sales');
    Route::post('sales/getList', 'Admin\SiteController@getSales');
    Route::post('sales/delete', 'Admin\SiteController@deleteSale');
    Route::get('services', 'Admin\SiteController@aServices')->name('services');
    Route::post('services/getList', 'Admin\SiteController@getServicesA');
    Route::post('services/delete', 'Admin\SiteController@deleteServiceA');

});

//Route::group(['domain' => env('FRONTEND_DOMAIN', 'texnika.kz')], function () {
    Route::get('/', 'SiteController@index');

    Route::post('/checkUsername', 'LoginController@checkUsername');

    Route::post('/register', 'LoginController@register');

    Route::post('/login', 'LoginController@login');

    Route::get('logout', function () {
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
    Route::post('/service/getObjects', 'ServiceController@getObjects');

    Route::get('/test', function () {
        dd((new \App\Sale())->getConditionOptions());
    });


    Route::get('mark', function () {
        return view('addmark');
    });

    Route::post('mark', function () {
        $mark = $_POST['mark'];
        $model = new \App\Mark();
        $model->value = $mark;
        $model->save();
        echo 'OK';
    });

    Route::get('checkAuth', function (){
        return response()->json(Auth::check());
    });
//});
