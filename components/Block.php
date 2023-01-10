<?php

declare(strict_types=1);

namespace Dimsog\Blocks\Components;

use Cms\Classes\ComponentBase;

class Block extends ComponentBase
{
    public function componentDetails(): array
    {
        return [
            'name'        => 'dimsog.blocks::lang.components.block.name',
            'description' => ''
        ];
    }

    public function defineProperties(): array
    {
        return [
            'id' => [
                'title' => 'dimsog.blocks::lang.components.block.id',
                'type' => 'string'
            ],
            'code' => [
                'title' => 'dimsog.blocks::lang.components.block.code',
                'type' => 'string'
            ]
        ];
    }
}
