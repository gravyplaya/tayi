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

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */ 

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

      's3' => [
            'aws' => [
                'driver' => 's3',
                'key' => "AKIGHDSYH5V4LKPYF7",
                'secret' => "MoOLLjdqfZB8pncoWoVXjpfkIEPzHspq3hsJuAla",
                'region' => "ap-south-1",
                'bucket' => "bucket-name",
                'url' => "bucket-url",
                'endpoint' => env('AWS_ENDPOINT'),

            ],
            'wasabi' => [
                'driver' => 's3',
                'key' => "KPTZ0JYHJGHJD4OALPDHG",
                'secret' => "r19GHDdH3eZRjmq7qcqSOzeoESDVG0ghfhgasf",
                'region' => "ap-southeast-1",
                'bucket' => "aifuse",
                'url' =>"bucket-url",
                'endpoint' =>"bucket-url",
            ]
            
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
