<?php

return [
	
	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, SparkPost and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/
	
	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
	],
	
	'ses' => [
		'key'    => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => 'us-east-1',
	],
	
	'sparkpost' => [
		'secret' => env('SPARKPOST_SECRET'),
	],
	
	'stripe' => [
		'model'  => App\User::class,
		'key'    => 'pk_test_Ozq7fWW5gnapw15qY6HmkQvs',
		'secret' => 'sk_test_rqdzOyA37A5H9PAvOgt3e90P',
	],
	
	'facebook' => [
		'client_id'     => '121557898469064',
		'client_secret' => '95f63294a19b7c4766873901a132da6a',
		'redirect'      => 'http://kipmuving.lo/auth/facebook/callback',
	],
	'google' => [
		'client_id'     => '113785953117-3fsr35g2v0c9e3kqelokdbktc8m3itv1.apps.googleusercontent.com',
		'client_secret' => 'vrQ8ccPjxhL00ftyw9xzhZsX',
		'redirect'      => 'http://kipmuving.lo/auth/gplus/callback',
	]

];
