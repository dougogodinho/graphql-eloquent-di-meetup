<?php

use App\Container;
use App\Model\User;
use GraphQL\Server\ServerConfig;
use GraphQL\Server\StandardServer;
use GraphQL\Utils\BuildSchema;

require_once __DIR__ . '/../vendor/autoload.php';

Container::getInstance()->boot();

$resolvers = [
    'hello' => 'world!',
    'users' => function () {
        return User::query()->get();
    },
    'user' => function ($source, $args) {
        return User::query()->find($args['id']);
    },
    "createUser" => function ($source, $args) {
        return User::query()->create($args['user']);
    }
];

$schema = BuildSchema::build(file_get_contents(__DIR__ . '/../config/schema.graphql'));

$config = ServerConfig::create()
    ->setSchema($schema)
    ->setDebug(true)
    ->setRootValue($resolvers);

$server = new StandardServer($config);

$server->handleRequest();