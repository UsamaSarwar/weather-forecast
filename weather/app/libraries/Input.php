<?php

namespace Fir\Libraries;

class Input {

    /**
     * Returns the value of a given parameter
     *
     * @param   string  $param  The parameter to get the value for
     * @return  string | bool
     */
    public static function get($param) {
        if(isset($_GET['url'])) {
            $url = explode('/', rtrim($_GET['url'], '/'));

            // Get the parameter id
            $pId = array_search($param, $url);

            // If the parameter id is found
            if($pId !== false) {
                // Return the parameter's value
                if(isset($url[$pId+1])) {
                    return $url[$pId+1];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}