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

    private function transformVariables($input)
    {
        return str_replace('{', ':', str_replace('}', '', $input));
    }

    public function get($route, $callback)
    {
        return $this->robodt->framework->get($this->transformVariables($route), $callback);
    }

    public function post($route, $callback)
    {
        return $this->robodt->framework->post($this->transformVariables($route), $callback);
    }

    public function put($route, $callback)
    {
        return $this->robodt->framework->put($this->transformVariables($route), $callback);
    }

    public function delete($route, $callback)
    {
        return $this->robodt->framework->delete($this->transformVariables($route), $callback);
    }
}
