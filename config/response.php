<?php

return [
    /*
     * Error Codes
     * ---------------
     * You can edit the codes
     */
    'codes' => [
        //--- client errors
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        423 => 'Locked',
        //--- server errors
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version not supported',
        511 => 'Network Authentication Required',
    ],
];