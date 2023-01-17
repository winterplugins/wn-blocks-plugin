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
        $block = null;
        if (!empty($this->property('code'))) {
            $block = BlockModel::findByCode($this->property('code'));
        } elseif (!empty($this->property('id'))) {
            $block = BlockModel::findById((int) $this->property('id'));
        }
        $this->page['model'] = $block;
        $this->page['isEditable'] = $this->isEditable();
        $this->page['cssClass'] = trim((string) $this->property('class', ''));
    }

    public function onFetchBlockContent(): array
    {
        if (!$this->isEditable()) {
            return [];
        }
        $block = $this->findBlockFromPostRequest();
        if (empty($block)) {
            return [];
        }
        return [
            '#app-block-item-' . $block->id => $block->text
        ];
    }

    public function onSaveBlockContent(): array
    {
        if (!$this->isEditable()) {
            return [
                'success' => false
            ];
        }
        $block = $this->findBlockFromPostRequest();
        if (empty($block)) {
            return [
                'success' => false
            ];
        }
        $block->text = (string) post('text');
        $block->save();
        return [
            'success' => true
        ];
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
            ],
            'class' => [
                'title' => 'dimsog.blocks::lang.components.block.class',
                'type' => 'string',
                'default' => ''
            ]
        ];
    }

    private function isEditable(): bool
    {
        return BackendAuth::check();
    }

    private function findBlockFromPostRequest(): ?BlockModel
    {
        return BlockModel::find((int) post('block_id'));
    }
}
