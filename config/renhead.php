<?php

return [

    /*
    |--------------------------------------------------------------------------
    | List of user types and payment approval statuses
    |--------------------------------------------------------------------------
    */

    'user' => [
        'type' => [
            'APPROVER'
        ]
    ],
    'payment' => [
        'approval' => [
            'status' => [
                'APPROVED',
                'DISAPPROVED'
            ]
        ]
    ]
];
