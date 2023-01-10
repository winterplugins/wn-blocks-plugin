<?php

declare(strict_types=1);

namespace Dimsog\Blocks\Components;

use Cms\Classes\ComponentBase;

class Block extends ComponentBase
{
    /**
     * Gets the details for the component
     */
    public function componentDetails()
    {
        return [
            'name'        => 'Block Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * Returns the properties provided by the component
     */
    public function defineProperties()
    {
        return [];
    }
}
