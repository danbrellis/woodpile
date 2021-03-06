<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        //Doctrine settings
        'doctrine' => [
            // if true, metadata caching is forcefully disabled
            'dev_mode' => isset($_ENV['docker']) ? $_ENV['docker'] : false,

            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            'cache_dir' => __DIR__ . '/../doctrine',

            // you should add any other path containing annotated entity classes
            'metadata_dirs' => [__DIR__ . '/../src'],

            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'db',
                'port' => 3306,
                'dbname' => 'woodpile',
                'user' => 'admin',
                'password' => 'admin',
                'charset' => 'utf8'
            ]
        ]
    ],
];
