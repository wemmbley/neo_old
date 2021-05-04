<?php

class View
{
    /**
     * @var object Neo
     */
    private $neo;

    private $themePath;

    private $themeName;

    public $styles;

    public $scripts;

    public $settings;

    public function __construct(Neo $neo)
    {
        $this->neo = $neo;

        $this->settings = $this->neo->getParam('settings');

        $this->themeName = $this->settings['theme'];

        $this->themePath = 'themes' . DIRECTORY_SEPARATOR . $this->themeName . DIRECTORY_SEPARATOR;
    }

    /**
     * Render theme page
     *
     * @param $fileName
     * @param array $params
     *
     * @throws \Exception
     */
    public function render($fileName) {
        if(!file_exists($this->themePath . $fileName)) {
            throw new \Exception('File ' . $fileName . 'not found.');
        }

        ob_start();
        require_once $this->themePath . $fileName;
        ob_get_flush();
    }

    public function requireStyle($path)
    {
        $this->styles .= '<link rel="stylesheet" href="' . $this->themePath . $path . '" type="text/css"> ';
    }

    public function requireScript($path, $inFooter = true)
    {
        $script = '<script src="' . $this->themePath . $path . '"></script> ';

        if($inFooter) {
            $this->scripts .= $script;

            return true;
        }

        $this->styles .= $script;

        return true;
    }
}