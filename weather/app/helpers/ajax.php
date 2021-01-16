<?php

/**
 * Check if the request is dynamic (ajax)
 *
 * @return  boolean
 */
function isAjax() {
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        // || isset($_GET['live'])
        ) {
        return true;
    } else {
        return false;
    }
}