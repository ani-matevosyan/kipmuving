<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Keys
    |--------------------------------------------------------------------------
    |
    | Set the public and private API keys as provided by reCAPTCHA.
    |
    | In version 2 of reCAPTCHA, public_key is the Site key,
    | and private_key is the Secret key.
    |
    */
//    the old one
//    'public_key'     => env('RECAPTCHA_PUBLIC_KEY', '6LcmWC0UAAAAAKpF7ZNyviQxDOVwe9sO-eXq8nUj'),
//    'private_key'    => env('RECAPTCHA_PRIVATE_KEY', '6LcmWC0UAAAAAMMyAKEYm4fItlBfAa1c2MuNsbM1'),

//     for dev
    'public_key'     => env('RECAPTCHA_PUBLIC_KEY', '6LdQSnAUAAAAAByFPA40zBxZ9fbMSuUdJ9-wnJqa'),
    'private_key'    => env('RECAPTCHA_PRIVATE_KEY', '6LdQSnAUAAAAAM_-YBjf10U0D_T2gK4ospu_de7d'),

//    for prod
//    'public_key'     => env('RECAPTCHA_PUBLIC_KEY', '6LcMlnAUAAAAAGhaBeMQOzoo20oNBIs8VDJJ96Q7'),
//    'private_key'    => env('RECAPTCHA_PRIVATE_KEY', '6LcMlnAUAAAAAMrJXKjUI8q5HGR9CDQbXCNgqTvA'),

    /*
    |--------------------------------------------------------------------------
    | Template
    |--------------------------------------------------------------------------
    |
    | Set a template to use if you don't want to use the standard one.
    |
    */
    'template'    => '',

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    |
    | Determine how to call out to get response; values are 'curl' or 'native'.
    | Only applies to v2.
    |
    */
    'driver'      => 'curl',

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | Various options for the driver
    |
    */
    'options'     => [

        'curl_timeout' => 1,

    ],

    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    |
    | Set which version of ReCaptcha to use.
    |
    */

    'version'     => 2,

];
