<?php

$validates = [
    'name' => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'error' => 'Not Valid User Name',
        'myOptions' => [
        "options" => ["regexp" => "/^[A-Za-z\s]+$/"]
        ]
    ],
    'email' => [
        'filter' => FILTER_VALIDATE_EMAIL,
        'error' => 'Not Valid User Email',
    ]
];