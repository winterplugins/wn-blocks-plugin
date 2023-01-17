<?php

declare(strict_types=1);

namespace Dimsog\Blocks\Components;

use Cms\Classes\ComponentBase;
use Dimsog\Blocks\Classes\BlocksCache;
use Dimsog\Blocks\Models\Block as BlockModel;

class BlocksPreloader extends ComponentBase
{
    public function componentDetails(): array
    {
        return [
            'name'        => 'dimsog.blocks::lang.components.blocks_preloader.name',
            'description' => ''
        ];
    }

    public function onRun(): void
    {
        $blocksCache = BlocksCache::instance();
        $query = BlockModel::query();
        if (!empty($this->property('id'))) {
            foreach (explode(',', $this->property('id')) as $id) {
                $query->orWhere('id', (int) $id);
            }
        }
        if (!empty($this->property('code'))) {
            foreach (explode(',', $this->property('code')) as $code) {
                $query->orWhere('code', trim($code));
            }
        }
        foreach ($query->get() as $block) {
            $blocksCache->add($block);
        }
    }

    public function defineProperties(): array
    {
        return [
            'id' => [
                'title' => 'dimsog.blocks::lang.components.blocks_preloader.id',
                'type' => 'string'
            ],
            'code' => [
                'title' => 'dimsog.blocks::lang.components.blocks_preloader.code',
                'type' => 'string'
            ]
        ];
    }
}
