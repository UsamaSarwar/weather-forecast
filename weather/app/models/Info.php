<?php

namespace Fir\Models;

class Info extends Model {

    /**
     * Get a specific page
     *
     * @param   string  $param  The page name
     */
    public function getPage($param) {}

    /**
     * Get all the available pages
     *
     * @return  array
     */
    public function getPages() {
        $query = $this->db->prepare("SELECT * FROM `info_pages` ORDER BY `id`");
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $data = [];

        while($row = $result->fetch_assoc()) {
            $data[$row['url']]['title']     = $row['title'];
            $data[$row['url']]['url']       = $row['url'];
            $data[$row['url']]['public']    = $row['public'];
            $data[$row['url']]['content']   = $row['content'];
        }

        return $data;
    }
}