<?php

namespace Fir\Models;

class Requests extends Model {

    /**
     * Get the list of locations available
     *
     * @param   array   $params
     * @return  array
     */
    public function getLocations($params) {
        $query = $this->db->prepare("SELECT * FROM `locations` WHERE `name` = ?");
        $query->bind_param('s', $params['location']);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $data = [];

        while($row = $result->fetch_assoc()) {
            $data[$row['id']]['id']         = $row['id'];
            $data[$row['id']]['name']       = $row['name'];
            $data[$row['id']]['country']    = $row['country'];
            $data[$row['id']]['lon']        = $row['lon'];
            $data[$row['id']]['lat']        = $row['lat'];
        }

        return $data;
    }
}