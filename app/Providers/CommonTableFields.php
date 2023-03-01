<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class CommonTableFields extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blueprint::macro('commonfields', function () {
            $this->timestamps();
            $this->integer('created_by')->nullable();
            $this->integer('updated_by')->nullable();
            $this->softDeletes();
            $this->integer('deleted_by')->nullable();
        });
    }
}
