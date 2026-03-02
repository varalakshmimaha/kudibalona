<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Show ALL Kannada translations grouped by category
echo "=== All Kannada Translations in DB ===\n\n";
$rows = \App\Models\CustomTranslation::where('is_hidden', false)
    ->whereNotNull('kannada_word')
    ->where('kannada_word', '!=', '')
    ->orderBy('english_word')
    ->get();

foreach ($rows as $t) {
    echo "  [{$t->id}] EN: {$t->english_word}\n       KN: {$t->kannada_word}\n\n";
}
echo "Total: " . $rows->count() . " translations\n";
