<?php

if (! function_exists('slugify')) {
    function slugify(string $name): string
    {
        return preg_replace(
            ['/-+/', '/^-|-$/'],
            ['-', ''],
            preg_replace(
                '/[^a-z0-9-]/',
                '',
                preg_replace('/\s+/', '-', strtolower(trim($name)))
            )
        );
    }
}