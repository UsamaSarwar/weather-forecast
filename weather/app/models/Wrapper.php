<?php

namespace Fir\Models;

class Wrapper extends Model {

    /**
     * Get the Info Pages
     *
     * @return  array
     */
    public function getInfoPages() {
        $query = $this->db->prepare("SELECT * FROM `info_pages` WHERE `public` = 1 ORDER BY `id`");
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $data = [];

        while($row = $result->fetch_assoc()) {
            $data[$row['url']]['title']     = $row['title'];
            $data[$row['url']]['url']       = $row['url'];
        }

        return $data;
    }
}