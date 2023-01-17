<?php

declare(strict_types=1);

namespace Dimsog\Blocks\Classes;

use Dimsog\Blocks\Models\Block;

class BlocksCache
{
    private static ?BlocksCache $instance = null;

    private array $blocksWithCodeKey = [];

    private array $blocksWithIdKey = [];


    private function __construct()
    {
    }

    public static function instance(): BlocksCache
    {
        if (empty(static::$instance)) {
            static::$instance = new BlocksCache();
        }
        return static::$instance;
    }

    public function add(Block $block): self
    {
        $this->blocksWithCodeKey[$block->code] = $block;
        $this->blocksWithIdKey[$block->id] = $block;
        return $this;
    }

    public function findByCode(string $code): ?Block
    {
        return $this->blocksWithCodeKey[$code] ?? null;
    }

    public function findById(int $id): ?Block
    {
        return $this->blocksWithIdKey[$id] ?? null;
    }
}