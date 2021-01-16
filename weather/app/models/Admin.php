<?php

namespace Fir\Models;

class Admin extends Model {

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $rememberToken;

    /**
     * Select an admin
     *
     * @param	int     $type   Switch the query between verification and retrieving
     * @return	array
     */
    public function get($type = null) {
        if($type == 2) {
            $query = $this->db->prepare("SELECT * FROM `admin` WHERE `username` = ? AND `remember_token` = ?");
            $query->bind_param('ss', $this->username, $this->rememberToken);
        } elseif($type == 1) {
            $query = $this->db->prepare("SELECT * FROM `admin` WHERE `username` = ? AND `password` = ?");
            $query->bind_param('ss', $this->username, $this->password);
        } else {
            $query = $this->db->prepare("SELECT * FROM `admin` WHERE `username` = ?");
            $query->bind_param('s', $this->username);
        }
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        $query->close();
        return $result;
    }

    /**
     * Save Settings for a given name
     *
     * @param   string  $name
     * @param   string  $value
     */
    public function insertUpdate($name, $value) {
        $query = $this->db->prepare("INSERT INTO `settings` (`name`, `value`) VALUES(?, ?) ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `value` = VALUES(`value`)");
        $query->bind_param('ss', $name, $value);
        $query->execute();
        $query->close();
    }

    /**
     * Save the Admin Panel Site Settings
     *
     * @param   array   $params
     */
    public function general($params) {
        $query = $this->db->prepare("INSERT INTO `settings` (`name`, `value`) VALUES('site_title', ?), ('timezone', ?), ('tracking_code', ?) ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `value` = VALUES(`value`)");
        $query->bind_param('sss', $params['site_title'], $params['timezone'], $params['tracking_code']);
        $query->execute();
        $query->close();
    }

    /**
     * Save the Admin Panel Weather Settings
     *
     * @param   array   $params
     */
    public function weather($params) {
        $query = $this->db->prepare("INSERT INTO `settings` (`name`, `value`) VALUES('weather_api_key', ?), ('weather_location', ?), ('weather_format', ?), ('weather_geo_location', ?), ('weather_forecast_days', ?), ('weather_latest', ?), ('search_per_ip', ?) ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `value` = VALUES(`value`)");
        $query->bind_param('ssiiiii', $params['weather_api_key'], $params['weather_location'], $params['weather_format'], $params['weather_geo_location'], $params['weather_forecast_days'], $params['weather_latest'], $params['search_per_ip']);
        $query->execute();
        $query->close();
    }

    /**
     * Delete all the latest searches
     */
    public function deleteLatestSearches() {
        $query = $this->db->prepare("TRUNCATE TABLE `latest_searches`");
        $query->execute();
        $query->close();
    }

    /**
     * Save the Admin Panel Ads Settings
     *
     * @param   array   $params
     */
    public function ads($params) {
        $query = $this->db->prepare("INSERT INTO `settings` (`name`, `value`) VALUES('ads_1', ?), ('ads_2', ?), ('ads_3', ?) ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `value` = VALUES(`value`)");
        $query->bind_param('sss', $params['ads_1'], $params['ads_2'], $params['ads_3']);
        $query->execute();
        $query->close();
    }

    /**
     * Save the Admin Panel Password Settings
     *
     * @param   array   $params
     */
    public function password($params) {
        $query = $this->db->prepare("UPDATE `admin` SET `password` = ? WHERE `username` = ?");
        $query->bind_param('ss', $params['password'], $this->username);
        $query->execute();
        $query->close();
    }

    /**
     * Renew the remember me token
     */
    public function renewToken() {
        $query = $this->db->prepare("UPDATE `admin` SET `remember_token` = ? WHERE `username` = ?");
        $query->bind_param('ss', $this->rememberToken, $this->username);
        $query->execute();
        $query->close();
    }

    /**
     * Set the site theme
     *
     * @param   array   $params
     */
    public function setTheme($params) {
        $query = $this->db->prepare("UPDATE `settings` SET `value` = ? WHERE `name` = 'site_theme'");
        $query->bind_param('s', $params['theme']);
        $query->execute();
        $query->close();
    }

    /**
     * Set the site default language
     *
     * @param   array   $params
     */
    public function setLanguage($params) {
        $query = $this->db->prepare("UPDATE `settings` SET `value` = ? WHERE `name` = 'site_language'");
        $query->bind_param('s', $params['language']);
        $query->execute();
        $query->close();
    }

    /**
     * Get all the available Info Pages
     *
     * @return  array
     */
    public function getInfoPages() {
        $query = $this->db->prepare("SELECT * FROM `info_pages` ORDER BY `id` DESC");
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $data = [];

        while($row = $result->fetch_assoc()) {
            $data[$row['id']]['id']        = $row['id'];
            $data[$row['id']]['title']     = $row['title'];
            $data[$row['id']]['url']       = $row['url'];
            $data[$row['id']]['public']    = $row['public'];
            $data[$row['id']]['content']   = $row['content'];
        }

        return $data;
    }

    /**
     * Find a specific Info Page
     *
     * @param   string  $value
     * @param   int     $type   Get a page by ID (0) or by URL (1)
     * @return  array
     */
    public function getInfoPage($value, $type) {
        if($type) {
            $query = $this->db->prepare("SELECT * FROM `info_pages` WHERE `url` = ?");
        } else {
            $query = $this->db->prepare("SELECT * FROM `info_pages` WHERE `id` = ?");
        }
        $query->bind_param('s', $value);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        $query->close();
        return $result;
    }

    /**
     * Update a specific Info Page
     *
     * @param   array   $params
     */
    public function updateInfoPage($params) {
        $query = $this->db->prepare("UPDATE `info_pages` SET `title` = ?, `url` = ?, `public` = ?, `content` = ? WHERE `id` = ?");
        $query->bind_param('ssiss', $params['page_title'], $params['page_url'], $params['page_public'], $params['page_content'], $params['page_id']);
        $query->execute();
        $query->close();
    }

    /**
     * Add a new Info Page
     *
     * @param   array   $params
     */
    public function addInfoPage($params) {
        $query = $this->db->prepare("INSERT INTO `info_pages` (`id`, `title`, `url`, `public`, `content`) VALUES (NULL, ?, ?, ?, ?);");
        $query->bind_param('ssis', $params['page_title'], $params['page_url'], $params['page_public'], $params['page_content']);
        $query->execute();
        $query->close();
    }

    /**
     * Delete an Info Page
     *
     * @param   array   $params
     */
    public function deleteInfoPage($params) {
        $query = $this->db->prepare("DELETE FROM `info_pages` WHERE `id` = ?");
        $query->bind_param('s', $params['page_id']);
        $query->execute();
        $query->close();
    }

    /**
     * Delete all the Search Limits
     */
    public function deleteSearchLimit() {
        $query = $this->db->prepare("TRUNCATE TABLE `search_limit`");
        $query->execute();
        $query->close();
    }
}