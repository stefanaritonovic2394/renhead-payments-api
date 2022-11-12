<?php

return [

    /*
    |--------------------------------------------------------------------------
    | List of user types and payment approval statuses
    |--------------------------------------------------------------------------
    */

    'user' => [
        'type' => [
            'APPROVER',
            'NOTAPPROVER'
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
