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
    public $app;

    public function __construct($site)
    {
        // Register Slim Framework
        $this->app = new \Slim\Slim();

        // Get and set site directory
        $this->app->site = function () use ($site)
        {
            return $site;
        };

        // Register Robodt as container
        $this->app->container->singleton('robodt', function() use ($site)
        {
            return new \Robodt\Robodt($site);
        });
    }

    public function get($route, $callback)
    {
        return $this->app->get($route, $callback);
    }

    public function mainRoute($route)
    {
        return $this->get($route . '(:url+)', function ($uri = array())
        {
            $app = \Slim\Slim::getInstance();

            $response = $app->robodt->render($uri);
            $response['debug'] = $response;

            $template = $app->site . 'theme';

            $app->config(array('templates.path' => $template));
            $app->render('template.php', $response, $response['request']['status']);
        });
    }

    public function run()
    {
        $this->app->run();
    }
}
