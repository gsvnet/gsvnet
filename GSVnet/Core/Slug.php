<?php namespace GSVnet\Core;

interface Slug {
    public function getSlug();
    static function generate($from = null);
}