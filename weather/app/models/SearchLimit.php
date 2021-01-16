<?php

namespace Fir\Models;

class SearchLimit extends Model {

    /**
     * Get all the IP information
     *
     * @param   array   $params
     * @return  array
     */
    public function getIp($params) {
        $query = $this->db->prepare("SELECT * FROM `search_limit` WHERE `ip` = ?");
        $query->bind_param('s', $params['ip']);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $data = [];

        while($row = $result->fetch_assoc()) {
            $data['ip']         = $row['ip'];
            $data['count']      = $row['count'];
            $data['updated_at'] = $row['updated_at'];
        }

        return $data;
    }

    /**
     * Add or update the user's IP status
     *
     * @param   array   $params
     */
    public function addIp($params) {
        $query = $this->db->prepare("INSERT INTO `search_limit` (`ip`, `count`) VALUES(?, 1) ON DUPLICATE KEY UPDATE `ip` = VALUES(`ip`), `count` = ?, `updated_at` = `updated_at`");
        $query->bind_param('si', $params['ip'], $params['count']);
        $query->execute();
        $query->close();
    }

    /**
     * Reset the user's IP count
     *
     * @param   array   $params
     */
    public function resetIp($params) {
        $query = $this->db->prepare("UPDATE `search_limit` SET `count` = 1 WHERE `ip` = ?");
        $query->bind_param('s', $params['ip']);
        $query->execute();
        $query->close();
    }
}