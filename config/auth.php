<?php

$auth = [
    'settings'=>[
        'main'=>[
            'userIdentify'=>'uid' // userIdentify can be (uid [for username] or email [for email])
        ],
        'change'=>[
            'pwd'=>true,
            'uid-email'=>false
        ],
        'additional_userinfos'=>[
            'location'=>false,
            'email-uid_2'=>false,
            'age'=>false
        ]
    ]
];