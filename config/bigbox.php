<?php

return [
    'base_url' => env('BIGBOX_API_MAIN_BASE_URL', 'https://api.thebigbox.id'),

    'sms' => [
        'key' => env('BIGBOX_SMS_KEY', 'N62FsPOpKYmim73DtNxP4l7b10LQ7jaZ'),
        'proxy' => env('BIGBOX_API_STAGING_PROXY', 'staging-proxy.thebigbox.id:1080'),

        'logging' => [
            'key' => env('BIGBOX_SMS_LOGGING_KEY', 'N62FsPOpKYmim73DtNxP4l7b10LQ7jaZ'),
            'endpoint' => env('BIGBOX_API_SMS_LOGGING_ENDPOINT', '/sms-dws-logging/2.0.0/elastic-log'),
            'proxy' => env('BIGBOX_API_STAGING_PROXY', 'staging-proxy.thebigbox.id:1080')
        ],
        'sender' => [
            'endpoint' => [
                'sender' => env('BIGBOX_API_SMS_SENDER_ENDPOINT', '/sms-dws-sender-config/2.0.0/sender'),
                'import-sender' => env('BIGBOX_API_SMS_SENDER_ENDPOINT', '/sms-dws-sender-config/2.0.0/sender-import'),
                'check-sender-credential' => env('BIGBOX_API_SMS_SENDER_ENDPOINT', '/sms-dws-sender-config/2.0.0/sender-verify/yourmasking'),
                'sender-flush-cache' => env('BIGBOX_API_SMS_SENDER_ENDPOINT', '/sms-dws-sender-config/2.0.0/sender-flush-cache'),
            ],
        ],
        'operator' => [
            'endpoint' => [
                'operator' => env('BIGBOX_API_SMS_OPERATOR_ENDPOINT', '/sms-dws-operator-config/2.0.0/operators'),
            ],
        ],
    ],

    'log' => [
        'type' => [
            'sender-management' => [
                'new-masking' => [
                    'message' => 'User Create New Masking Sender'
                ],
                'import-masking' => [
                    'logging-name' => 'import-masking',
                    'message' => 'User Create Import Sender'
                ],
                'delete' => [
                    'logging-name' => 'delete-sender',
                    'message' => 'User Deleted SenderId '
                ]
            ],
            'user-management' => [
                'new-user' => [
                    'message' => 'Created New User'
                ],
                'edit-user' => [
                    'message' => 'Edited Data User'
                ],
                'delete-user' => [
                    'message' => 'Deleted Data User'
                ],
            ],
            'login' => [
                'message' => 'User Success Login'
            ],
            'traffic-report' => [
                'message' => 'User Downloaded Data Traffic'
            ]
        ]
    ]
];
