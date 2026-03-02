<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = \Illuminate\Http\Request::create('/', 'GET');
$_COOKIE['site_lang'] = 'kn';

$response = new \Illuminate\Http\Response('<html><head><title>Koodibhalona Trust</title></head><body><h1>Welcome to Koodibhalona Trust</h1><p>About Koodibhalona Trust.</p></body></html>');
$response->headers->set('Content-Type', 'text/html');

$middleware = new \App\Http\Middleware\CustomTranslationMiddleware();
$result = $middleware->handle($request, function($req) use ($response) {
    return $response;
});

echo $result->getContent();

