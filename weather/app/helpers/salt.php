<?php

/**
 * Generate a random salt
 *
 * @param   int     $length     The length of the salt to be returned
 *
 * @return  string
 */
function generateSalt($length = 10) {
    $salt = null;
    $salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));

    for($i = 0; $i < $length; $i++) {
        $salt .= $salt_chars[array_rand($salt_chars)];
    }

    return $salt;
}