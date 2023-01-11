<?php

declare(strict_types=1);

namespace Dimsog\Blocks\Components;

use Backend\Facades\BackendAuth;
use Backend\Traits\UploadableWidget;
use Cms\Classes\ComponentBase;
use Dimsog\Blocks\Models\Block as BlockModel;

class Block extends ComponentBase
{
    use UploadableWidget;

    public $uploadPath = '/uploaded-files';


    public function componentDetails(): array
    {
        return [
            'name'        => 'dimsog.blocks::lang.components.block.name',
            'description' => ''
        ];
    }

    public function onRun(): void
    {
        if ($this->isEditable()) {
            $this->controller->addCss('/plugins/dimsog/blocks/assets/style.css', 'Dimsog.Blocks');
            $this->controller->addJs('/plugins/dimsog/blocks/assets/script.js', 'Dimsog.Blocks');
        }
    }

    public function onRender(): void
    {
        $this->page['model'] = BlockModel::findByIdOrCode(
            (int) $this->property('id'),
            $this->property('code')
        );
        $this->page['isEditable'] = $this->isEditable();
    }

    public function onUploadImage()
    {
        if (!$this->isEditable()) {
            return;
        }
        return $this->onUpload();
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
