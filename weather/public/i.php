<center>
<?php
function error($message) {
    return '<div style="color: red">'.$message.'</div>';
}
function enabled($message) {
    return '<div style="color: green">'.$message.'</div>';
}
function info($message) {
    return '<div style="color: blue">'.$message.'</div>';
}

if(version_compare(PHP_VERSION, '7.0.0') >= 0) {
    echo enabled('PHP Version: '.PHP_VERSION.' (OK)');
} else {
    echo error('PHP Version: '.PHP_VERSION.', (NOT OK) - You must update to at least: PHP 7');
}

if(function_exists('mysqli_connect')) {
    echo enabled('MySQLi: Enabled (OK)');
} else {
    echo error('MySQLi: Disabled (NOT OK)');
}

if(function_exists('mysqli_fetch_all')) {
    echo enabled('MySQL Native Driver: Enabled (OK)');
} else {
    echo error('MySQL Native Driver: Disabled (NOT OK)');
}

if(extension_loaded('openssl')) {
    echo enabled('OpenSSL: Enabled (OK)');
} else {
    echo error('OpenSSL: Disabled (NOT OK)');
}

if(function_exists('curl_version')) {
    echo enabled('cURL: Enabled (OK)');
} else {
    echo error('cURL: Disabled (NOT OK)');
}

if(extension_loaded('mbstring')) {
    echo enabled('mbstring: Enabled (OK)');
} else {
    echo error('mbstring: Disabled (NOT OK)');
}

echo info('post_max_size: '.ini_get('post_max_size'));
echo info('upload_max_filesize: '.ini_get('upload_max_filesize'));
echo info('max_execution_time: '.ini_get('max_execution_time'));
echo info('max_file_uploads: '.ini_get('max_file_uploads'));
?>
</center>