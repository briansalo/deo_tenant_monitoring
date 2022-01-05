<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


use App\Models\todo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            //compose all the views....
            view()->composer('*', function ($view) 
            {       
                   $todo = todo::all(); 
                   $count_todo = count($todo);
        
                    $view->with('count_todo', $count_todo); 


             });// view composer 
    }
}
