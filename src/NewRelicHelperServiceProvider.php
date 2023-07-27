<?php

namespace FaithFM\NewRelicHelper;

use Illuminate\Support\ServiceProvider;

class NewRelicHelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        //Set APM appname
        NewRelicHelper::setApmName();
    }
}
