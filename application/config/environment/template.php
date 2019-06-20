<?php
return [
    'database' => [
        'driver' => 'pdo_mysql',
        'dbname' => 'diaries',
        'user' => '...',
        'password' => '...',
        'host' => '...',
        'charset' => 'utf8',
    ],

    /**
     * Base URL for non-http requests and all other cases when
     * the Base URL cannot be determined automatically from $_SERVER
     */
    'ssl_required' => true,
    'show_errors' => false,

    /**
     * Doctrine configuration settings for Entity Manager
     * @link http://docs.doctrine-project.org/en/2.0.x/reference/configuration.html
     */
    'doctrine' => [
        'auto_generate_proxies' => false,
        'cache_class' => \Doctrine\Common\Cache\ApcuCache::class,
        'cache_namespace' => 'diaries',
    ],
];