<?php

namespace Inventori\Providers;

use Illuminate\Support\ServiceProvider;

class InventoriProvider extends ServiceProvider {

    public function boot() {

        require __DIR__ . '/../Http/routes.php';

        $this->loadViewsFrom(__DIR__ . '/../Resources/Emails', 'inventori.emails');

        $this->publishes([
            __DIR__ . '/../Database/Migrations/' => database_path('migrations/inventori')
                ], 'migrations');
    }

    public function register() {

        $this->mergeConfigFrom(__DIR__ . '/../Config/kondisi.php', 'inventori.kondisi');
    }

}
