<?php
$content = '<option>Home</option><textarea>About Us</textarea><title>Testing Title</title><div>About Us</div><input placeholder="About Us">';
$translations = ['About Us' => 'ನಮ್ಮ ಬಗ್ಗೆ', 'Home' => 'ಮುಖಪುಟ', 'Testing Title' => 'ಪರೀಕ್ಷೆಯ ಶೀರ್ಷಿಕೆ'];

// Pass 1
$placeholders = [];
$content = preg_replace_callback(
    '/(<(script|style|title|textarea|option)\b[^>]*>.*?<\/\2>)|(^|(?<=>))([^<]+)((?=<)|$)/is',
    function ($matches) use ($translations, &$placeholders) {
        if (!empty($matches[1])) {
            return $matches[1];
        }
        $text = $matches[4];
        if (trim($text) === '') {
            return $matches[3] . $text . $matches[5];
        }
        foreach ($translations as $english => $translated) {
            if (empty($english)) continue;
            if (stripos($text, $english) !== false) {
                $ph = "\x00TR" . count($placeholders) . "\x00";
                $placeholders[$ph] = '<span class="notranslate">' . $translated . '</span>';
                $text = str_ireplace($english, $ph, $text);
            }
        }
        return $matches[3] . $text . $matches[5];
    },
    $content
);
if (!empty($placeholders)) {
    $content = strtr($content, $placeholders);
}

// Pass 2
$content = preg_replace_callback(
    '/(<(title|textarea|option)\b[^>]*>)(.*?)(<\/\2>)|\b(alt|placeholder|title|aria-label)="([^"]*?)"/is',
    function ($matches) use ($translations) {
        if (!empty($matches[1])) {
            $openTag = $matches[1];
            $text = $matches[3];
            $closeTag = $matches[4];
            foreach ($translations as $english => $translated) {
                $text = str_ireplace($english, $translated, $text);
            }
            return $openTag . $text . $closeTag;
        }
        $attr = $matches[5];
        $val  = $matches[6];
        foreach ($translations as $english => $translated) {
            $val = str_ireplace($english, $translated, $val);
        }
        return $attr . '="' . $val . '"';
    },
    $content
);
echo $content;
