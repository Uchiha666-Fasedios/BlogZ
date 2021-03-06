<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
//esta la agrego para subir imagenes
        'users' => [//se llama users el disco (la carpeta)debo crear esta carpeta
            'driver' => 'local',
            'root' => storage_path('app/users'),//la ubicacion donde va a estar storage/app/users
            'url' => env('APP_URL').'/storage',//la ubicacion donde empieza
            'visibility' => 'public',
        ],

        //esta la agrego para subir imagenes
                'images' => [//se llama users el disco (la carpeta)debo crear esta carpeta
                    'driver' => 'local',
                    'root' => storage_path('app/images'),//la ubicacion donde va a estar
                    'url' => env('APP_URL').'/storage',//la ubicacion donde empieza
                    'visibility' => 'public',
                ],
                //esta la agrego para subir imagenes
                'videos' => [//se llama users el disco (la carpeta)debo crear esta carpeta
                    'driver' => 'local',
                    'root' => storage_path('videos'),//la ubicacion donde va a estar
                    'url' => env('APP_URL').'/public',//la ubicacion donde empieza
                    'visibility' => 'public',
                ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],

];
