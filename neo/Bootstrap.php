<?php

/**
 * Class Bootstrap
 */
class Bootstrap
{
    /**
     * DI container
     * @var Neo
     */
    private $neo;

    /**
     * Bootstrap constructor.
     * @param Neo $neo
     */
    public function __construct(Neo $neo)
    {
        $this->neo = $neo;

        $this->loadCoreModules();
        $this->loadPlugins();
        $this->neo->addNestedParam('modules', 'Router', (new Router($this->neo)));
    }

    /**
     * Load user's plugins
     * @throws Exception
     */
    private function loadPlugins()
    {
        $plugins = scandir(ABSPATH . 'plugins' . DIRECTORY_SEPARATOR);

        foreach ($plugins as $pluginName) {
            $pluginInitPath = ABSPATH . 'plugins' . DIRECTORY_SEPARATOR . $pluginName . DIRECTORY_SEPARATOR . $pluginName . '.php';

            if (file_exists($pluginInitPath)) {
                require_once $pluginInitPath;

                if (class_exists($pluginName)) {
                    $plugin = new $pluginName($this->neo);

                    $this->neo->addNestedParam('plugins', $pluginName, $plugin);
                }
            }
        }

        $this->neo->getParam('db')->close();
    }

    /**
     * Load system modules
     */
    private function loadCoreModules()
    {
        $this->neo->addNestedParam('modules', 'View', (new View($this->neo)));

    }
}