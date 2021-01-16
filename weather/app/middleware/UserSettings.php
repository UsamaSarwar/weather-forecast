<?php

namespace Fir\Middleware;

/**
 * Class UserSettings sets the default user settings when navigating for the first time on site
 */
class UserSettings {

    /**
     * @var int
     */
    private $darkMode = 0;

    public function __construct() {
        if(isset($_COOKIE['dark_mode']) == false || in_array($_COOKIE['dark_mode'], ['0', '1']) == false) {
            setcookie("dark_mode", $this->darkMode, time() + (10 * 365 * 24 * 60 * 60), COOKIE_PATH);
            $_COOKIE['dark_mode'] = $this->darkMode;
        }

        if(isset($_COOKIE['favorites']) == false || json_decode($_COOKIE['favorites']) == false) {
            $expire = time() + (10 * 365 * 24 * 60 * 60);
            $favorites = json_encode(['items' => (object)[], 'path' => COOKIE_PATH, 'expire' => $expire]);

            setcookie("favorites", $favorites, $expire, COOKIE_PATH);
            $_COOKIE['favorites'] = $favorites;
        }

        if(isset($_COOKIE['lat']) == false) {
            setcookie("lat", 0, time() + (10 * 365 * 24 * 60 * 60), COOKIE_PATH);
            $_COOKIE['lat'] = 0;
        }

        if(isset($_COOKIE['lon']) == false) {
            setcookie("lon", 0, time() + (10 * 365 * 24 * 60 * 60), COOKIE_PATH);
            $_COOKIE['lon'] = 0;
        }
    }
}