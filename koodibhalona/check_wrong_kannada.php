<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$wrong = 'ಕೂಡಿಭಲೋನಾ';
$correct = 'ಕೂಡಿಬಾಳೋಣ';

// Check all columns in custom_translations
try {
    $rows = DB::select("SELECT * FROM custom_translations WHERE kannada_word LIKE ? OR english_word LIKE ?", [
        "%$wrong%", "%Koodibhalona%"
    ]);
    echo "=== custom_translations (wrong Kannada or Koodibhalona) ===\n";
    foreach ($rows as $r) {
        echo "  ID={$r->id} | EN={$r->english_word} | KN={$r->kannada_word}\n";
    }

    // Fix any wrong Kannada if found
    $fixCount = DB::update("UPDATE custom_translations SET kannada_word = REPLACE(kannada_word, ?, ?) WHERE kannada_word LIKE ?", [
        $wrong, $correct, "%$wrong%"
    ]);
    echo "Fixed $fixCount rows in custom_translations.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

// Check site_settings
try {
    $allSettings = DB::select("SELECT `key`, `value` FROM site_settings WHERE `value` LIKE '%ಕೂಡ%' LIMIT 20");
    echo "\n=== site_settings with Kannada content ===\n";
    foreach ($allSettings as $s) {
        echo "  key={$s->key} | value={$s->value}\n";
    }

    $fixSettings = DB::update("UPDATE site_settings SET `value` = REPLACE(`value`, ?, ?) WHERE `value` LIKE ?", [
        $wrong, $correct, "%$wrong%"
    ]);
    echo "Fixed $fixSettings rows in site_settings.\n";
} catch (Exception $e) {
    echo "site_settings error: " . $e->getMessage() . "\n";
}

// Check translations table (if exists)
try {
    $transRows = DB::select("SELECT * FROM translations WHERE value LIKE ? LIMIT 10", ["%$wrong%"]);
    echo "\n=== translations table with wrong Kannada ===\n";
    if (empty($transRows)) echo "  None found.\n";
    foreach ($transRows as $r) {
        print_r($r);
    }
    $fixTrans = DB::update("UPDATE translations SET value = REPLACE(value, ?, ?) WHERE value LIKE ?", [
        $wrong, $correct, "%$wrong%"
    ]);
    echo "Fixed $fixTrans rows in translations.\n";
} catch (Exception $e) {
    echo "translations table error: " . $e->getMessage() . "\n";
}

echo "\nAll done.\n";
