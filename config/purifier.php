<?php

return [
    'encoding' => 'UTF-8',
    'finalize' => true,
    'preload' => false,
    'settings' => [
        'default' => [
            'HTML.Doctype' => null,
            'HTML.Allowed' => 'h2,h3,h4,h5,h6,div,pre,code,b,blockquote,cite,strong,i,em,a[href|title],ul,ol,li,p,br,span,img[width|height|alt|src|class],table,hr,tr,td[align],th[align]',
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty' => true,
            'AutoFormat.Linkify' => true,
            'HTML.Nofollow' => true,
            'HTML.TargetBlank' => true
        ],
    ],
];