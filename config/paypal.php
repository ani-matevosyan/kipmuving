<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
//    'sandbox' => [
//        'username'    => env('PAYPAL_SANDBOX_API_USERNAME', 'sanek.solodovnikov.94-facilitator_api1.gmail.com'),
//        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', '65J9SF8SVX2QYJDV'),
//        'secret'      => env('PAYPAL_SANDBOX_API_SECRET', 'AFcWxV21C7fd0v3bYYYRCpSSRl31A8X8liG7tjU97y2UpyEUu6x-HSKJ'),
//        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
//        'app_id'      => 'APP-80W284485P519543T',    // Used for testing Adaptive Payments API in sandbox mode
//    ],
    'sandbox' => [
        'username'    => env('PAYPAL_SANDBOX_API_USERNAME', 'contacto-facilitator_api1.kipmuving.com'),
        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', '2JZSH53Q4JY79H3U'),
        'secret'      => env('PAYPAL_SANDBOX_API_SECRET', 'A9frNSjdg56YUh3IOj8EoShIiMclAq9C.MaTyUJSoP-kp8lV4eYmPPhD'),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id'      => 'APP-80W284485P519543T',    // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', 'contacto-facilitator_api1.kipmuving.com'),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', '2JZSH53Q4JY79H3U'),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', 'A9frNSjdg56YUh3IOj8EoShIiMclAq9C.MaTyUJSoP-kp8lV4eYmPPhD'),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => '',         // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
    'currency'       => 'USD',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
];
