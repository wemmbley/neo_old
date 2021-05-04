<?php

/**
 * Class HomeController
 */
class HomeController
{
    /**
     * @var object Neo
     */
    private $neo;

    /**
     * HomeController constructor.
     * @param Neo $neo
     * @throws Exception
     */
    public function __construct(Neo $neo)
    {
        $this->neo = $neo;

        $this->displayHome();
    }

    /**
     * Render index file
     * @throws Exception
     */
    private function displayHome()
    {
        $view = $this->neo->getParam('modules')['View'];
        $view->requireStyle('assets\css\main.css');
        $view->requireStyle('assets\css\theme.css');
        $view->requireScript('assets\js\main.js');
        $view->requireScript('assets\js\theme.js');
        $view->render('index.php');
    }

}