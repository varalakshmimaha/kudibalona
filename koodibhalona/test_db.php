<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$translations = \App\Models\CustomTranslation::all();
$out = "";
foreach ($translations as $t) {
    if (stripos($t->english_word, 'Koodibhalona') !== false) {
        $out .= "ID: " . $t->id . "\n";
        $out .= "EN: [" . $t->english_word . "]\n";
        $out .= "KN: [" . $t->kannada_word . "]\n";
        $out .= "-----------------\n";
    }
}
file_put_contents('test_db_out2.txt', $out);
