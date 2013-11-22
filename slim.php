<?php

/**
 * Robodt - Markdown CMS
 * @author      Zomnium
 * @link        http://www.zomnium.com
 * @copyright   2013 Zomnium, Tim van Bergenhenegouwen
 */


// Register Slim Framework
$app = new \Slim\Slim();

// Get and set site directory
$app->site = function () use ($site)
{
    return $site;
};

// Register Robodt as container
$app->container->singleton('robodt', function() use ($site, $app)
{
    return new \Robodt\Robodt($site);
});

// Main route controller
$app->get('/(:url+)', function ($uri = array()) use ($app)
{
    $response = $app->robodt->render($uri);
    $response['debug'] = $response;
    $template = implode( DIRECTORY_SEPARATOR, array(
        $app->site,
        'theme'));
    $app->config(array('templates.path' => $template));
    $app->render('template.php', $response, $response['request']['status']);
});