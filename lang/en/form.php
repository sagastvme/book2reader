<?php

return [
    'books' => 'Upload books',
    'books_help' => 'Select one or more files to send to your e-reader. Supported formats: :formats.',
    'url' => 'Link',
    'url_help' => 'Paste a link to an online article or webpage to send it directly to your e-reader.',
    'trim_margins' => 'Trim Margins',
    'trim_margins_help' => 'Crops out excessive blank space around the page edges, making text larger and easier to read.',
    'transliterate' => 'Transliterate',
    'transliterate_help' => 'Converts non-latin characters into their latin equivalents for better e-reader compatibility (e.g. "Привет" → "Privet", "Ελλάδα" → "Ellada").',    'process' => [
        'label' => 'E-reader Optimization',
        'none' => 'None',
        'none_desc' => 'Send the file as-is, without any conversion or modification.',
        'kobo' => 'Kobo (Kepubify)',
        'kobo_desc' => 'Converts the EPUB to the enhanced Kobo format (KEPUB) for improved performance and reading experience on Kobo devices.',
        'kindle' => 'Kindle (KindleGen)',
        'kindle_desc' => 'Converts the ebook to MOBI format, compatible with Kindle devices and the Kindle app.',
    ],
    'submit' => 'Send to e-reader',
];
