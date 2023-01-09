<?php

declare(strict_types=1);

namespace Dimsog\Blocks\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('dimsog_blocks_categories', static function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dimsog_blocks_categories');
    }
}
