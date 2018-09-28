<?php

Route::group(['middleware' => 'web', 'prefix' => 'demomodule', 'namespace' => 'Modules\DemoModule\Http\Controllers'], function()
{
    Route::get('/', 'DemoModuleController@index');
});
