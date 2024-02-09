<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageSection extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'page_sections';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'published',
        'custom_class',
        'default_section_classes',
        'section_title',
        'section',
        'section_nickname',
        'order',
        'css',
        'js',
        'cdn_css',
        'cdn_js',
        'use_editor',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const DEFAULT_SECTION_CLASSES_SELECT = [
        'ptb-100'          => 'Section Top & Bottom Spaced 100px',
        'pb-100'           => 'Section Bottom Spaced 100px',
        'pt-100'           => 'Section Top Spaced 100px',
        'pt-100 pb-70'     => 'Section Top & Bottom Spaced 100px/70px',
        'bg-color ptb-100' => 'Default With Background Color',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
