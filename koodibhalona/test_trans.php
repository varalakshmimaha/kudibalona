<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$translations = \App\Models\CustomTranslation::all();
foreach ($translations as $t) {
    if (stripos($t->english_word, 'Koodibhalona') !== false) {
        echo $t->english_word . " => " . $t->kannada_word . "\n";
    }
}
