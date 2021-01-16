<?php

/**
 * Convert the characters into HTML entities
 *
 * @param   string  $value  The string to be escaped
 * @return  string
 */
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Limit the amount of characters in a string and provide an excerpt of it
 *
 * @param   string  $value  The string to be parsed
 * @param   int     $limit  The number of characters to be returned
 * @param   string  $end    The string to be appended
 * @return  string
 */
function str_limit($value, $limit = 100, $end = '...') {
    if(strlen($value) > $limit) {
        $value = substr(strip_tags($value), 0, $limit);
        $value = $value.$end;
    } else {
        $value = strip_tags($value);
    }

    return $value;
}