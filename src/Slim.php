<?php

/**
 * Robodt - Markdown CMS
 * @author      Zomnium
 * @link        http://www.zomnium.com
 * @copyright   2013 Zomnium, Tim van Bergenhenegouwen
 */

namespace Robodt\Adapter;

class FrameworkSlim
{
    public $framework;

    public function __construct($site)
    {
        // Register Slim Framework
        $this->framework = new \Slim\Slim();

        // Get and set site directory
        $this->framework->site = function () use ($site)
        {
            return $site;
        };

        // Register Robodt as container
        $this->framework->container->singleton('robodt', function() use ($site)
        {
            return new \Robodt\Robodt($site);
        });
    }

    public function get($route, $callback)
    {
        return $this->framework->get($route, $callback);
    }

    public function mainRoute($route)
    {
        return $this->get($route . '(:url+)', function ($uri = array())
        {
            $framework = \Slim\Slim::getInstance();

            $response = $framework->robodt->render($uri);
            $response['debug'] = $response;

            $template = $framework->site . 'theme';

            $framework->config(array('templates.path' => $template));
            $framework->render('template.php', $response, $response['request']['status']);
        });
    }

    public function run()
    {
        $this->framework->run();
    }
}
