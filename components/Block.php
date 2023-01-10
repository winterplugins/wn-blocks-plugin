<?php

declare(strict_types=1);

namespace Dimsog\Blocks\Components;

use Backend\Facades\BackendAuth;
use Cms\Classes\ComponentBase;
use Dimsog\Blocks\Models\Block as BlockModel;

class Block extends ComponentBase
{
    public function componentDetails(): array
    {
        return [
            'name'        => 'dimsog.blocks::lang.components.block.name',
            'description' => ''
        ];
    }

    public function onRender(): void
    {
        $this->page['model'] = BlockModel::findByIdOrCode(
            (int) $this->property('id'),
            $this->property('code')
        );
        $this->page['isEditable'] = $this->isEditable();
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

    private function isEditable(): bool
    {
        return BackendAuth::check();
    }
}
