<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class StaticSeo extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'static_seos';

    protected $appends = [
        'seo_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const OPEN_GRAPH_TYPE_SELECT = [
        'website' => 'Website',
        'article' => 'Article',
        'product' => 'Product',
    ];

    public const CONTENT_TYPE_SELECT = [
        'custom'     => 'Pages Builder',
        'post'       => 'Blog Post',
        'news'       => 'Press',
        'casestudy'  => 'Case Study',
        'whitepaper' => 'White Paper',
        'promo'      => 'Promo',
        'product'    => 'Product',
        'event'      => 'Event',
        'faq'        => 'FAQ',
    ];

    protected $fillable = [
        'page_name',
        'page_path',
        'meta_title',
        'facebook_title',
        'twitter_title',
        'content_type',
        'json_ld_tag',
        'canonical',
        'html_schema_1',
        'html_schema_2',
        'html_schema_3',
        'body_schema',
        'facebook_description',
        'twitter_description',
        'meta_description',
        'open_graph_type',
        'menu_name',
        'seo_image_url',
        'noindex',
        'nofollow',
        'noimageindex',
        'noarchive',
        'nosnippet',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getSeoImageAttribute()
    {
        $file = $this->getMedia('seo_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
