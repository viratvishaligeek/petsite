<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, HasSeo;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'featured_image',
        'description',
        'status',
    ];


    public function seo()
    {
        return $this->morphOne(SeoPlugin::class, 'seoable');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}