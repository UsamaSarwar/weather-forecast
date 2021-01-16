<?php

namespace Fir\Connection;

/**
 * The database class which creates the database connection
 */
class Database {

    /**
     * Starts the database connection
     * @return \mysqli
     */
    public function connect() {
        $db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($db->connect_errno) {
            echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
            exit;
        }
        $db->set_charset("utf8");
        return $db;
    }
}