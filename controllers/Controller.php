<?php
namespace app\controllers;


use app\services\renderers\IRenderer;
use app\services\renderers\TemplateRenderer;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = "main";
    private $useLayout = true;

    private $renderer = null;

    /**
     * Controller constructor.
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function run($action = null)
    {
        $this->action = $action?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if(method_exists($this, $method)){
            $this->$method();
        }else{
            echo "404";
        }
    }

    public function render($template, $params = [])
    {
        if($this->useLayout){
            $content = $this->renderTemplate($template, $params);
            return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
        }
        return $this->renderTemplate($template, $params);
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }
}