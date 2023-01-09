<?php

declare(strict_types=1);

namespace Dimsog\Blocks;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails(): array
    {
        return [
            'name'        => 'dimsog.blocks::lang.plugin.name',
            'description' => 'dimsog.blocks::lang.plugin.description',
            'author'      => 'Dimsog',
            'icon'        => 'icon-file-text-o'
        ];
    }
}
