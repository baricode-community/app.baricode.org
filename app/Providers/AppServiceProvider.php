<?php

namespace App\Providers;

use App\Listeners\General\Security\LogUserLogin;
use App\Listeners\General\Security\LogUserLogout;
use App\Models\ProgressJournal;
use App\Observers\ProgressJournalObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Blade component paths
        Blade::anonymousComponentPath(resource_path('views/components'), '');

        // Register view namespaces
        View::addNamespace('layouts', resource_path('views/components/layouts'));

        $this->app['events']->listen(Login::class, LogUserLogin::class);
        $this->app['events']->listen(Logout::class, LogUserLogout::class);

        // Register observers
        ProgressJournal::observe(ProgressJournalObserver::class);
    }
}
