<?php

namespace Fir\Models;

/**
 * The base Model upon which all the other models are extended on
 */
class Model {

    /**
     * The database connection
     * @var	\mysqli
     */
    protected $db;

    function __construct($db) {
        $this->db = $db;
    }

    /**
     * Gets the site `settings`
     *
     * @return	array
     */
    public function getSiteSettings() {
        $query = $this->db->prepare("SELECT * FROM `settings`");
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $data = [];

        while($row = $result->fetch_assoc()) {
            $data[$row['name']] = $row['value'];
        }

        return $data;
    }

    /**
     * @param $string
     * @return string
     */
    private function e($string) {
        return $this->db->real_escape_string($string);
    }
}