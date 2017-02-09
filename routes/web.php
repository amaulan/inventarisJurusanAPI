<?php

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'api'], function() {
    Route::group(['prefix' => 'jurusan'], function() {
        Route::post('/',        'Api\JurusanController@index');
        Route::post('/store',   'Api\JurusanController@store');
        Route::post('/delete',  'Api\JurusanController@delete');
        Route::post('/show',    'Api\JurusanController@show');
        Route::post('/update',    'Api\JurusanController@update');
    });

    Route::group(['prefix' => 'kategori'], function(){
        Route::post('/',        'Api\KategoriController@index');
        Route::post('/store',   'Api\KategoriController@store');
        Route::post('/delete',  'Api\KategoriController@delete');
        Route::post('/show',    'Api\KategoriController@show');
        Route::post('/update',  'Api\KategoriController@update');
    });

    Route::group(['prefix' => 'ruangan'], function(){
        Route::post('/',        'Api\RuanganController@index');
        Route::post('/store',   'Api\RuanganController@store');
        Route::post('/delete',  'Api\RuanganController@delete');
        Route::post('/show',    'Api\RuanganController@show');
        Route::post('/update',  'Api\RuanganController@update');
    });

    Route::group(['prefix' => 'supplier'], function(){
        Route::post('/',        'Api\SupplierController@index');
        Route::post('/store',   'Api\SupplierController@store');
        Route::post('/delete',  'Api\SupplierController@delete');
        Route::post('/show',    'Api\SupplierController@show');
        Route::post('/update',  'Api\SupplierController@update');
    });

    Route::group(['prefix' => 'barang'], function(){
        Route::post('/',        'Api\BarangController@index');
        Route::post('/store',   'Api\BarangController@store');
        Route::post('/delete',  'Api\BarangController@delete');
        Route::post('/show',    'Api\BarangController@show');
        Route::post('/update',  'Api\BarangController@update');
    });
});