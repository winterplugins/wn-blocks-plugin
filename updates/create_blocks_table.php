<?php

declare(strict_types=1);

namespace Dimsog\Blocks\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class CreateBlocksTable extends Migration
{
    public function up()
    {
        Schema::create('dimsog_blocks_blocks', static function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('category_id');
            $table->string('name');
            $table->string('code')->unique();
            $table->longText('text')->nullable();

            $table->foreign('category_id')
                ->references('id')
                ->on('dimsog_blocks_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dimsog_blocks_block');
    }
}
