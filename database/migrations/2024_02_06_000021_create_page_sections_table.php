<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('published')->default(0)->nullable();
            $table->string('custom_class')->nullable();
            $table->string('default_section_classes')->nullable();
            $table->string('section_title')->nullable();
            $table->longText('section');
            $table->string('section_nickname')->nullable();
            $table->integer('order')->nullable();
            $table->longText('css')->nullable();
            $table->longText('js')->nullable();
            $table->longText('cdn_css')->nullable();
            $table->longText('cdn_js')->nullable();
            $table->boolean('use_editor')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
