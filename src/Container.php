<?php

namespace App;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Builder;

class Container extends \Illuminate\Container\Container
{
    public function __construct()
    {
        $this->registerDatabase();
    }

    public function boot()
    {
        $this->make(Manager::class);
        return $this;
    }

    public function registerDatabase()
    {
        $this->singleton(Manager::class, function () {
            $capsule = new Manager();
            $capsule->addConnection([
                'driver' => 'sqlite',
                'database' => __DIR__ . '/../database.sqlite'
            ]);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            return $capsule;
        });

        $this->bind(Builder::class, function () {
            return $this->call(function (Manager $capsule) {
                return $capsule->getConnection()->getSchemaBuilder();
            });
        });
    }
}