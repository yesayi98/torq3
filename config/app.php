<?php

return [
     /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | application needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
     */
    'name' => 'Torq-3',
    /*
       |--------------------------------------------------------------------------
       | Application Timezone
       |--------------------------------------------------------------------------
       |
       | Here you may specify the default timezone for your application, which
       | will be used by the PHP date and date-time functions. We have gone
       | ahead and set this to a sensible default for you out of the box.
       |
       */
    'timezone' => 'asia/yerevan',
    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */
    'debug' => true,

    /*
      |--------------------------------------------------------------------------
      | Application Url
      |--------------------------------------------------------------------------
      |
      | Application url will be used by application in some cases.
      |
      */
    'url' => 'http://localhost',
    /*
    |--------------------------------------------------------------------------
    | Application Cache Path
    |--------------------------------------------------------------------------
    |
    | Application will be save their caches in this path.
    |
    */
    'cache_dir' => '/cache/',

    /*
      |--------------------------------------------------------------------------
      | Application Cache Path
      |--------------------------------------------------------------------------
      |
      | Application will be save their caches in this path.
      |
  */
    'view_path' => '/resources/views/',

    'proxy_dir' => null,

    'model_dirs' => [
      'engine/Models',
    ],

    'use_annotation' => false
];