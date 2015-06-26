<?php

return [
    'adminEmail' => 'admin@example.com',

    'bootstrap' => ['debug'],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['176.193.138.72']
        ]
    ]
];
