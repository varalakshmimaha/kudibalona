<?php
$text = "About Koodibhalona Trust";
$english = "Koodibhalona";

$pattern = '/\b' . preg_quote($english, '/') . '\b/i';
$placeholder = '~~TR_0~~';

$newText = preg_replace($pattern, $placeholder, $text);
echo $newText . "\n";
