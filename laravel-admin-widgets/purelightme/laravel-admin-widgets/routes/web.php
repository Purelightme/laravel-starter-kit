<?php

use Purelightme\Widget\Http\Controllers\WidgetController;

Route::get('laravel-admin-widgets', WidgetController::class.'@index');