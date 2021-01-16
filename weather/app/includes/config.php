<?php
error_reporting(0);
define('FIR', true);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_NAME', 'Database');
define('DB_PASS', '');

define('URL_PATH', 'http://localhost/weather');

define('PUBLIC_PATH', 'public');
define('THEME_PATH', 'themes');
define('STORAGE_PATH', 'storage');
define('UPLOADS_PATH', 'uploads');

// define('COOKIE_PATH', preg_replace('|https?://[^/]+|i', '', URL_PATH).'/');
define('COOKIE_PATH', preg_replace('http://[^/]+|i', '', URL_PATH).'/');