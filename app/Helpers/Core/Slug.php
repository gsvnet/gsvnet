<?php namespace App\Helpers\Core;

interface Slug {
    static function generate($from = null);
}