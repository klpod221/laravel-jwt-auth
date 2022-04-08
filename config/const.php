<?php

return [
    // General
    'error_message' =>  'An error has occurred.',
    'default_string_length' => 191,
    'default_country_id' => 1,
    'default_date_format' => 'd/m/Y',
    'default_limit' => 15,
    'response_success' => 'success',
    'activated_status' => 1,
    'verification_expire_time' => 120, // day unit
    'callback_confirmation_url' => env('CALLBACK_CONFIRMATION_URL'),
    'callback_application_url' => env('CALLBACK_APPLICATION_URL'),

    // Regex pattern rules
    'rule' => [
        'phone' => 'regex:/(02|03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/',
        'password' => 'regex:/(?=^.{8,16}$)((?=.*\d)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', // 8 - 16 characters, have at least 1 capital letter and 1 special character
        'date' => 'date_format:d/m/Y',
    ],
];
