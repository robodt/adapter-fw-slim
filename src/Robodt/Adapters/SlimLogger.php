<?php

/**
 * Robodt - Markdown CMS
 * @author      Zomnium
 * @link        http://www.zomnium.com
 * @copyright   2013 Zomnium, Tim van Bergenhenegouwen
 */

namespace Robodt\Adapters;

use Robodt\Components\Component as Component;
use Robodt\Components\RobodtLogger as RobodtLogger;

class SlimLogger extends Component implements RobodtLogger
{
    /* logging */

    public function add($record)
    {
        return true;
    }
}
