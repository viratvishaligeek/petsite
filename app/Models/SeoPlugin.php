<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoPlugin extends Model
{
    use BelongsToTenant, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [

        'tenant_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'meta_robots',
        'slug',
        'canonical_tag',
        'og_title',
        'og_description',
        'og_type',
        'og_url',
        'og_image',
        'og_site',
        'og_locale',
        'og_video',
        'og_audio',
        'twitter_card',
        'twitter_site',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'twitter_url',
        'indexing_switch',
        'schema',

    ];

    public function seoable()
    {
        return $this->morphTo();
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    protected $hidden = [
        'tenant_id',
    ];
}
