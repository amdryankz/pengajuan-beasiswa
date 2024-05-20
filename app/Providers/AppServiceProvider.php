<?php

namespace App\Providers;

use App\Models\ScholarshipData;
use Illuminate\Support\ServiceProvider;
use App\Observers\ScholarshipDataObserver;

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
        ScholarshipData::observe(ScholarshipDataObserver::class);
    }
}
