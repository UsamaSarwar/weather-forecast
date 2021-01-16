<?php

namespace Fir\Controllers;
use Fir\Libraries\Weather as Weather;
use Fir\Libraries\Input as Input;

class Home extends Controller {

    /**
     * @var object
     */
    protected $model;

    public function index() {
        $search_limit = false;

        // If search per IP is enabled
        if($this->settings['search_per_ip'] > 0) {
            $this->model = $this->model('SearchLimit');

            $user = $this->model->getIp(['ip' => $_SERVER['REMOTE_ADDR']]);

            $user['count'] = isset($user['count']) ? $user['count'] : 0;

            // If the user has done more queries than allowed in a given time frame
            if($user['count'] >= $this->settings['search_per_ip'] && (time()-strtotime($user['updated_at']) < $this->settings['search_time'])) {
                $search_limit = true;
            } else {
                // Reset the counter if the time frame has exceeded
                if(isset($user['updated_at']) && time()-strtotime($user['updated_at']) > $this->settings['search_time']) {
                    $this->model->resetIp(['ip' => $_SERVER['REMOTE_ADDR']]);
                } else {
                    $this->model->addIp(['ip' => $_SERVER['REMOTE_ADDR'], 'count' => $user['count']+1]);
                }
            }
        }

        $this->model = $this->model('Home');
        $data = [];

        // Change the format
        if(isset($_POST['format'])) {
            $data['format'] = $this->setFormat();
        } else {
            $data['format'] = $this->getFormat();
        }

        // Add or remove an item from Favorites list
        if(isset($_POST['favorite']) && isset($_POST['id']) && isset($_POST['name'])) {
            $data['favorite'] = $this->setFavorite();
        }

        $weather = new Weather($this->settings['weather_api_key']);
        $weather->units = $data['format'];
        $weather->days  = $this->settings['weather_forecast_days'];

        $getLocation = Input::get('location');

        // If user searched for a location
        if($getLocation !== false) {
            $data['location'] = substr($getLocation, 0, 32);
            $weatherNow = $search_limit ?: $weather->get(null, null, $data['location'], 0, 0, null, null);
        } else {
            // Get the user's location if available
            try {
                // If the geo location is disabled
                if($this->settings['weather_geo_location'] == 0 || ($_COOKIE['lat'] == 0 && $_COOKIE['lon'] == 0)) {
                    throw new \Exception();
                }
                // Get the location
                $coordinates[] = $_COOKIE['lat'];
                $coordinates[] = $_COOKIE['lon'];

                $data['location'] = implode(', ', $coordinates);

                $weatherNow = $search_limit ?: $weather->get(null, $coordinates, null, 0, 0, null, null);
            } catch (\Exception $e) {
                // Use the default location
                $data['location'] = $this->settings['weather_location'];

                // If the default location is a location_id
                if(is_numeric($data['location'])) {
                    $weatherNow = $search_limit ?: $weather->get(null, null, $data['location'], 0, 0, null, null);
                } else {
                    $weatherNow = $search_limit ?: $weather->get($data['location'], null, null, 0, 0, null, null);
                }
            }
        }

        $data['weather_now'] = $search_limit ?: $weather->data(2, $weatherNow);

        // If there's a Now weather forecast
        if(isset($data['weather_now']['location_id'])) {
            $weatherForecast = $weather->get(null, null, $data['weather_now']['location_id'], 1, 0, null, null);

            // Fetch the hourly forecast
            if(isset($this->url[2]) && $this->url[2] == 'day') {
                $data['weather_forecast'] = $weather->data(1, $weatherForecast, $this->url[3]);
            }
            // Fetch the daily forecast
            else {
                $data['weather_forecast'] = $weather->data(1, $weatherForecast);
            }
        }

        // If the API response is not 200 (success) or 404 (city not found), and there's an error message
        if((isset($data['weather_now']['cod']) && $data['weather_now']['cod'] != 200 && $data['weather_now']['cod'] != 404 && isset($data['weather_now']['message'])) || $search_limit == true) {
            if($search_limit == true) {
                $_SESSION['message'][] = ['info', $this->lang['search_l_e']];
            } else {
                $_SESSION['message'][] = ['error', $data['weather_now']['message']];
            }
        }

        if(isset($data['weather_now']) && ((isset($data['weather_forecast']['forecast']) && count($data['weather_forecast']['forecast']) > 0) || (isset($data['weather_forecast']['hourly']) && count($data['weather_forecast']['hourly'])))) {
            $data['coordinates'] = $this->model->getCoordinates(['id' => $data['weather_now']['location_id']]);
            $data['favorite'] = $this->getFavorite($data['weather_now']['location_id']);

            // If the Latest Searched is enabled
            if($this->settings['weather_latest']) {
                $data['latest_searches'] = $this->model->getLocations(['limit' => $this->settings['weather_latest']]);

                // If user searched for a location
                if($getLocation !== false) {
                    $this->model->addLocation(['location' => $data['weather_now']['location_id']]);

                    $this->view->metadata['title'] = [$this->lang['weather'], $data['weather_now']['location']];
                }
            }

            if(isset($this->url[2]) && $this->url[2] == 'day') {
                $data['forecast_view'] = $this->view->render($data, 'home/hourly');
            } else {
                $data['forecast_view'] = $this->view->render($data, 'home/daily');
            }

            $data['results_view'] = $this->view->render($data, 'home/weather');
        } else {
            $data['results_view'] = $this->view->render($data, 'home/error');
        }

        return ['content' => $this->view->render($data, 'home/content')];
    }

    /**
     * Get the user selected format (*C or *F), or the site default format
     *
     * @return  string | int
     */
    private function getFormat() {
        // If the user has selected a format
        if(isset($_COOKIE['format']) && in_array($_COOKIE['format'], ['0', '1'])) {
            $format = $_COOKIE['format'];
        }
        // Else use the default format
        else {
            $format = $this->settings['weather_format'];
        }
        return $format;
    }

    /**
     * Set the format (*C or *F)
     *
     * @return int
     */
    private function setFormat() {
        $value = $_POST['format'];
        setcookie("format", $value, time() + (10 * 365 * 24 * 60 * 60), COOKIE_PATH);
        $_COOKIE['format'] = $value;
        return $value;
    }

    /**
     * Checks whether the current location is already on favorites list or not
     *
     * @param   $id
     * @return  boolean
     */
    private function getFavorite($id) {
        $list = json_decode($_COOKIE['favorites'], true);

        if(array_key_exists($id, $list['items'])) {
            return true;
        }
        return false;
    }

    /**
     * Add or remove an item from the Favorites list
     */
    private function setFavorite() {
        $list = json_decode($_COOKIE['favorites'], true);

        $found = false;

        if(array_key_exists($_POST['id'], $list['items'])) {
            $found = true;
        }

        if($found === true) {
            // Remove the item
            unset($list['items'][$_POST['id']]);
        } else {
            // Add the item
            $list['items'][$_POST['id']] = $_POST['name'];
        }

        $list = json_encode($list);

        // Store the list as an object
        setcookie("favorites", $list, time() + (10 * 365 * 24 * 60 * 60), COOKIE_PATH);
        $_COOKIE['favorites'] = $list;
    }
}