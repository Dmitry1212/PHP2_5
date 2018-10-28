<?php


namespace app\services\renderers;


class TwigRenderer implements IRenderer
{
    private $twig;

    /**
     * TwigRenderer constructor.
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(ROOT_DIR. 'views/twig');
        $this->$twig = new \Twig_Environment($loader);
    }

    public function render($template, $params = [])
    {
        $template .= '.twig';
        return $this->$twig->render($template, $params);

    }

}