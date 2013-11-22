<?php

namespace Robodt\Adapter\Framework\Slim;

use Pimple;
use Robodt;
use Slim;

class AdapterFrameworkSlim
{
    public $site;
    // public $container;
    // public $robodt;
    // public $app;

    public function __construct($site)
    {
        $this->site = $site;
        $container = new \Pimple();
        $container['app'] = $container->share( function ()
        {
            return new \Slim\Slim( array(

                // Development
                'mode' => 'development',
                'debug' => true,
                'log.level' => \Slim\Log::DEBUG,

                // Cookies
                'cookies.lifetime' => '20 minutes',
                'cookies.path' => '/',
                'cookies.domain' => 'robodt.dev',
                'cookies.secure' => false,
                'cookies.httponly' => false,
                'cookies.secret_key' => 'ultrasonicsecret',
                'cookies.cipher' => MCRYPT_RIJNDAEL_256,
                'cookies.cipher_mode' => MCRYPT_MODE_CBC,

                // Protocol
                'http.version' => '1.1',
            ));
        });

        $container['robodt'] = $container->share( function () use ($site)
        {
            return new \Robodt\Robodt($site);
        });

        $container['app']->get('/(:url+)', function ( $uri = array() ) use ($container, $site)
        {
            $response = $container['robodt']->render($uri);
            $response['debug'] = $response;
            $template = implode( DIRECTORY_SEPARATOR, array(
                $site,
                'theme'));
            $container['app']->config(array('templates.path' => $template));
            $container['app']->render('template.php', $response, $response['request']['status']);
        });

        $container['app']->run();
    }

}