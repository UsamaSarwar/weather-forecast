<?php

namespace Fir\Models;

class Home extends Model {

    /**
     * Add the latest searched location in the database
     *
     * @param   array   $params
     */
    public function addLocation($params) {
        $query = $this->db->prepare("INSERT INTO `latest_searches` (`value`) VALUES(?)");
        $query->bind_param('i', $params['location']);
        $query->execute();
        $query->close();
    }

    /**
     * Get the last N searched locations from the database
     *
     * @param   array   $params
     * @return  array
     */
    public function getLocations($params) {
        $query = $this->db->prepare("SELECT `locations`.`id`, `locations`.`name`, `locations`.`country` FROM `locations` AS `locations` INNER JOIN (SELECT `value`, MAX(`id`) AS `id` FROM `latest_searches` GROUP BY `value` ORDER BY `id` DESC LIMIT ?) AS `latest_searches` ON `locations`.`id` = `latest_searches`.`value`");
        $query->bind_param('i', $params['limit']);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $data = [];

        while($row = $result->fetch_assoc()) {
            $data[$row['id']]['id']         = $row['id'];
            $data[$row['id']]['name']       = $row['name'];
            $data[$row['id']]['country']    = $row['country'];
        }

        return $data;
    }

    /**
     * Get the location coordinates
     *
     * @param   array   $params
     * @return  array
     */
    public function getCoordinates($params) {
        $query = $this->db->prepare("SELECT * FROM `locations` WHERE `id` = ?");
        $query->bind_param('i', $params['id']);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $data = [];

        while($row = $result->fetch_assoc()) {
            $data['id']         = $row['id'];
            $data['name']       = $row['name'];
            $data['country']    = $row['country'];
            $data['lat']        = $row['lat'];
            $data['lon']        = $row['lon'];
        }

        return $data;
    }
}