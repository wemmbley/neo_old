<?php

class Menu
{
    /**
     * @var object Neo
     */
    private $neo;

    /**
     * @var array $menu
     */
    private $menu;

    public function __construct(Neo $neo)
    {
        $this->neo = $neo;

        $this->getMenu();
        // $this->displayMenu();
    }

    public function getMenu()
    {
        $db = $this->neo->getParam('db');

        $menu = $db->query('SELECT
                        menu.id AS id,
                        menu.name AS name,
                        menu_categories.name AS category,
                        menu.url AS url
                    FROM menu
                    LEFT JOIN menu_categories
                    ON menu.category_id = menu_categories.id');

        $this->menu = $menu;

        return $menu;
    }

    public function displayMenu()
    {
        $settings = $this->neo->getParam('settings');

        for ($i = 0; $i < count($this->menu); $i++) {
            $menu_item = $this->menu[$i];

            echo '<a href="'. $settings['site_url'] . $menu_item['url'] .'">'. $menu_item['name'] .'</a>';
        }
    }
}