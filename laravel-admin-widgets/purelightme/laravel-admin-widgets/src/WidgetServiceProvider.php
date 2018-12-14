<?php

namespace Purelightme\Widget;

use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Widget $extension)
    {
        if (! Widget::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-widgets');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/purelightme/laravel-admin-widgets')],
                'laravel-admin-widgets'
            );
        }

        $this->app->booted(function () {
            Widget::routes(__DIR__.'/../routes/web.php');
        });
    }
}