<?php

return [
    'adapters' => [
        'application2' => [
            'driver' => 'local',
            'root' => storage_path('application2'),
            'sub_applications' => [
                'subapp1' => [
                    'driver' => 'local',
                    'root' => storage_path('application2/subapp1'),
                ],
                'subapp2' => [
                    'driver' => 'local',
                    'root' => storage_path('application2/subapp2'),
                ],
                // Add more sub-applications as needed
            ],
        ],
    ],
];
