<?php

namespace App\Providers;

use App\Repositories\ButtonInterface;
use App\Repositories\ButtonRepository;
use App\Repositories\ComponentInterface;
use App\Repositories\ComponentRepository;
use App\Repositories\SwitchInterface;
use App\Repositories\SwitchRepository;
use App\Repositories\UnitInterface;
use App\Repositories\UnitRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(UnitInterface::class,UnitRepository::class);
        $this->app->bind(ComponentInterface::class,ComponentRepository::class);
        $this->app->bind(SwitchInterface::class,SwitchRepository::class);
        $this->app->bind(ButtonInterface::class,ButtonRepository::class);

    }
}
