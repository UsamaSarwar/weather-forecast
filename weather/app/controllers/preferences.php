<?php

namespace Fir\Controllers;

class Preferences extends Controller {
    
    /**
     * @var array
     */
    protected $pages = ['language', 'theme'];

    public function index() {
        // Redirect to the default Preference Page
        redirect('preferences/language');
    }

    public function language() {
        $data['menu_view'] = $this->menu();

        $data['user_language'] = $this->language;
        $data['languages'] = $this->languages;
        $data['preferences_view'] = $this->view->render($data, 'preferences/language');

        if(isset($_POST['submit']) && isset($_POST['site_language'])) {
            $_SESSION['message'][] = ['success', $this->lang['settings_saved']];
            redirect('preferences/language');
        }

        $data['page_title'] = $this->lang['language'];

        $this->view->metadata['title'] = [$this->lang['preferences'], $this->lang['language']];
        return ['content' => $this->view->render($data, 'preferences/content')];
    }

    public function theme() {
        $data['menu_view'] = $this->menu();

        $data['user_theme'] = $_COOKIE['dark_mode'];

        $data['preferences_view'] = $this->view->render($data, 'preferences/theme');

        if(isset($_POST['submit'])) {
            if(isset($_POST['dark_mode']) && $_POST['dark_mode'] == 1) {
                setcookie("dark_mode", 1, time() + (10 * 365 * 24 * 60 * 60), COOKIE_PATH);
            } else {
                setcookie("dark_mode", 0, time() + (10 * 365 * 24 * 60 * 60), COOKIE_PATH);
            }

            $_SESSION['message'][] = ['success', $this->lang['settings_saved']];
            redirect('preferences/theme');
        }

        $data['page_title'] = $this->lang['theme'];

        $this->view->metadata['title'] = [$this->lang['preferences'], $this->lang['theme']];
        return ['content' => $this->view->render($data, 'preferences/content')];
    }

    /**
     * The Preferences menu
     *
     * @return  string
     */
    private function menu() {
        $pages = $this->pages;

        // Array Map: Key(Menu Elements) => Array(Bold, Not Dynamic tag, Title)
        foreach($pages as $page) {
            $data['menu'][$page] = [false, false, $page];
        }

        // If on the current route, enable the Bold flag
        $data['menu'][$this->url[1]][0] = true;

        return $this->view->render($data, 'preferences/menu');
    }
}