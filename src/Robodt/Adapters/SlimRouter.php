<?php

/**
 * Robodt - Markdown CMS
 * @author      Zomnium
 * @link        http://www.zomnium.com
 * @copyright   2013 Zomnium, Tim van Bergenhenegouwen
 */

namespace Robodt\Adapters;

use Robodt\Components\Component as Component;
use Robodt\Components\RobodtRouter as RobodtRouter;

class SlimRouter extends Component implements RobodtRouter
{
    /* routing */

    public function get($route, $callback)
    {
        return $this->robodt->framework->get($route, $callback);
    }

    public function post($route, $callback)
    {
        return $this->robodt->framework->post($route, $callback);
    }

    public function put($route, $callback)
    {
        return $this->robodt->framework->put($route, $callback);
    }

    public function delete($route, $callback)
    {
        return $this->robodt->framework->delete($route, $callback);
    }
}
