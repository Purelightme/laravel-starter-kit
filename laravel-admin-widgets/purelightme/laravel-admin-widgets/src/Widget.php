<?php

namespace Purelightme\Widget;

use Encore\Admin\Extension;

class Widget extends Extension
{
    public $name = 'laravel-admin-widgets';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Widget',
        'path'  => 'laravel-admin-widgets',
        'icon'  => 'fa-gears',
    ];
}