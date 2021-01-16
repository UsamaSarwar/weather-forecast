<?php

namespace Fir\Controllers;

class Info extends Controller {

    /**
     * @var object
     */
    protected $model;

    public function index() {
        $this->model = $this->model('Info');

        $pages = $this->model->getPages();

        $availablePages = array_keys($pages);

        // If the page accessed does not exist or if there's no page specified
        if(!in_array($this->url[1], $availablePages) || !isset($this->url[1])) {
            redirect();
        }

        // Select the current page
        $page = $pages[$this->url[1]];

        $data['menu_view'] = $this->menu($pages);
        $data['page_content'] = $page['content'];
        $data['page_title'] = $page['title'];

        $this->view->metadata['title'] = [$this->lang['info'], $page['title']];
        return ['content' => $this->view->render($data, 'info/content')];
    }

    /**
     * The Info Pages menu
     *
     * @param   array   $pages  The info pages
     * @return  string
     */
    private function menu($pages) {
        // Array Map: Key(Menu Elements) => Array(Bold, Not Dynamic tag, Title)
        foreach($pages as $page) {
            $data['menu'][$page['url']] = [false, false, $page['title']];
        }

        // If on the current route, enable the Bold flag
        $data['menu'][$this->url[1]][0] = true;

        return $this->view->render($data, 'info/menu');
    }
}