<?php
/**
 * ------------------------------------
 * Define all the request options here
 * ------------------------------------
 */
return [
    /**
     * ------------------------------------
     * set the base endpoint and urls here
     * ------------------------------------
     */
    'url' => [
        'endpoint' => 'https://api.smsales.co.ke/api/v1/',
        'smsales' => [
            'token' => 'token', // GET
            'sms' => 'sms', // GET
            'send' => 'sms/send', // POST
        ]
    ],

    /**
     * ---------------------------------------------------------------
     * This should be the api account token that is generated in the
     * pam account.
     * ---------------------------------------------------------------
     */
    'smsales_token' => env('SMSALES_API_TOKEN', 'bm9kZTw+c2VjcmV0'),

    /**
     * ---------------------------------------------------------------------------------------------------
     * The timeout is the time given for the response to be given if no response is given
     * in 60 seconds the request is dropped.
     * You are free to set your timeout
     * ---------------------------------------------------------------------------------------------------
     */
    'timeout' => env('TIMEOUT', 60), // Response timeout 60sec

    /**
     * ---------------------------------------------------------------------------------------------------
     * The connection timeout is the time given for the request to acquire full connection to the
     * end point url. So if not connection is made in 60 seconds the request is dropped.
     * Your free to set your own connection timeout.
     * ---------------------------------------------------------------------------------------------------
     */
    'connect_timeout' => env('CONNECTION_TIMEOUT', 60), // Connection timeout 60sec
];
