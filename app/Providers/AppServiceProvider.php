<?php

namespace App\Providers;
use App\Models\Department;
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
  

public function boot()
{
    View::composer('*', function ($view) {
        $departments = Department::where('status', 'active')->get();
        $view->with('departments', $departments);
    });
}
}
