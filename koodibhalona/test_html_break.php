<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Set cookie for the middleware to pick up
$_COOKIE['site_lang'] = 'hi';

$request = Illuminate\Http\Request::create('/', 'GET');
// Also set in Request for consistency
$request->cookies->set('site_lang', 'hi');

$response = app()->handle($request);

file_put_contents('output_hi.html', $response->getContent());
echo "Done! Wrote output_hi.html.";
