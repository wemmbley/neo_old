<?php

/**
 * Class Neo
 * App container
 */
class Neo
{
    /**
     * Dependency injection container
     *
     * @var array
     */
    private $container;

    /**
     * Neo constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->loadPDO();
        $this->loadCoreSettings();
    }

    /**
     * Add param into container
     *
     * @param $key
     * @param $value
     */
    public function addParam($key, $value)
    {
        $this->container[$key] = $value;
    }

    /**
     * Add param into container with double nesting
     *
     * @param $key
     * @param $nestedKey
     * @param $value
     */
    public function addNestedParam($key, $nestedKey, $value)
    {
        $this->container[$key][$nestedKey] = $value;
    }

    /**
     * Get param from container
     *
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public function getParam($key)
    {
        if(!isset($this->container[$key])) {
            throw new Exception('Param not found - ' . $key);
        }

        return $this->container[$key];
    }

    /**
     * Load framework settings from DB
     *
     * @throws Exception
     */
    private function loadCoreSettings()
    {
        $db = $this->getParam('db');
        $settings = $db->query('SELECT * FROM settings');

        for ($i = 0; $i < count($settings); $i++) {
            $this->addNestedParam('settings', $settings[$i]['setting'], $settings[$i]['value']);
        }
    }

    /**
     * Add PDO object into container
     */
    private function loadPDO()
    {
        $this->addParam('db', (new DB()));
    }
}