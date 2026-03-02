<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$wrong  = 'ಕೂಡಿಭಲೋನಾ';
$correct = 'ಕೂಡಿಬಾಳೋಣ';

// Fix any DB rows whose kannada_word contains the wrong spelling
$rows = \App\Models\CustomTranslation::all();
$fixed = 0;
foreach ($rows as $row) {
    $changed = false;
    foreach (['kannada_word', 'telugu_word', 'hindi_word', 'tamil_word'] as $col) {
        if ($row->$col && str_contains($row->$col, $wrong)) {
            $row->$col = str_replace($wrong, $correct, $row->$col);
            $changed = true;
        }
    }
    if ($changed) {
        $row->save();
        $fixed++;
        echo "Fixed row ID: {$row->id} | EN: {$row->english_word}\n";
    }
}

echo "\nTotal rows fixed: $fixed\n";

// Also list all current Kannada translations for review
echo "\n--- Current Kannada translations ---\n";
foreach (\App\Models\CustomTranslation::where('is_hidden', false)->whereNotNull('kannada_word')->where('kannada_word','!=','')->get() as $t) {
    echo "[{$t->id}] {$t->english_word} => {$t->kannada_word}\n";
}
