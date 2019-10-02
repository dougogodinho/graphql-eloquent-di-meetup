<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Container;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

$container = Container::getInstance();

touch(__DIR__ . '/../database.sqlite');

$container->call(function (Builder $builder) {

    $builder->dropAllTables();

    $builder->create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email');
        $table->json('address');
        $table->date('birthday');
        $table->timestamps();
    });

    $builder->create('posts', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->text('content');
        $table->integer('user_id')->unsigned();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users');
    });

    $builder->create('comments', function (Blueprint $table) {
        $table->increments('id');
        $table->text('content');
        $table->string('name');
        $table->string('email');
        $table->integer('post_id')->unsigned();
        $table->timestamps();

        $table->foreign('post_id')->references('id')->on('posts');
    });

    $builder->create('follows', function (Blueprint $table) {
        $table->integer('user_id')->unsigned();
        $table->integer('followed_id')->unsigned();

        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('followed_id')->references('id')->on('users');
    });

});