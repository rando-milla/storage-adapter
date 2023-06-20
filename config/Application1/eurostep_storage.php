<?php

return [
    'adapters' => [
        'application1' => [
            'driver' => 'local',
            'root' => storage_path('application1'),
            'sub_applications' => [
                'subapp1' => [
                    'driver' => 'local',
                    'root' => storage_path('application1/subapp1'),
                ],
                'subapp2' => [
                    'driver' => 'local',
                    'root' => storage_path('application1/subapp2'),
                ],
                // Add more sub-applications as needed
            ],
        ],
    ],
];
