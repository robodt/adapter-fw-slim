<?php

/**
 * Robodt - Markdown CMS
 * @author      Zomnium
 * @link        http://www.zomnium.com
 * @copyright   2013 Zomnium, Tim van Bergenhenegouwen
 */

namespace Robodt\Adapters;

use Robodt\Components\Component as Component;
use Robodt\Components\RobodtHooks as RobodtHooks;

class SlimHooks extends Component implements RobodtHooks
{
    /* hooks */

    public function set($name, $callback)
    {
        $this->robodt->framework->hook($name, $callback);
    }

    public function remove($name)
    {
        return false; // Not supported
    }

    public function apply($name)
    {
        $this->robodt->framework->applyHook($name);
    }
}
