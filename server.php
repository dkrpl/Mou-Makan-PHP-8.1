<?php
/**
 * Router script for PHP Built-in Server
 * Usage: php -S localhost:8000 server.php
 */

$uri = urldecode(
    parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/', PHP_URL_PATH) ?? ''
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a CodeIgniter
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';
require_once __DIR__ . '/index.php';
