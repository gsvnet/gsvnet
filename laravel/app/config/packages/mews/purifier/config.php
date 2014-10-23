<?php

/*
 * This file is part of HTMLPurifier Bundle.
 * (c) 2012 Maxime Dizerens
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array(
	'encoding' => 'UTF-8',
    'finalize' => true,
    'preload'  => false,
    'settings' => array(
        'default' => array(
            'HTML.Doctype'             => 'XHTML 1.0 Strict',
            'HTML.Allowed'             => 'h2,h3,h4,h5,h6,div,b,blockquote,cite,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src|class]',
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty'   => true,
            'AutoFormat.Linkify'       => true,
            'HTML.Nofollow'            => true,
            'HTML.TargetBlank'         => true
        ),
    ),
);
