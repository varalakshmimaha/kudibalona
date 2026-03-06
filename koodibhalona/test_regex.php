<?php
$content = '<option>Home</option><textarea>About Us</textarea><div>About Us</div>';
$content = preg_replace_callback(
    '/(<(script|style|title|option|textarea)\b[^>]*>.*?<\/\2>)|(^|(?<=>))([^<]+)((?=<)|$)/is',
    function ($matches) {
        if (!empty($matches[1])) {
            return $matches[1];
        }
        $text = $matches[4];
        return $matches[3] . '<span class="notranslate">' . $text . '</span>' . $matches[5];
    },
    $content
);
echo $content;
