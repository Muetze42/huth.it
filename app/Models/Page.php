<?php

namespace App\Models;

use App\Helpers\Sitemap;
use App\Traits\ErrorExceptionNotify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, ErrorExceptionNotify;

    const ROBOTS = [
        0 => 'noindex,nofollow',
        1 => 'noindex,follow',
        2 => 'index,nofollow',
        3 => 'index,follow',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route',
        'title',
        'description',
        'og_title',
        'og_description',
        'robots',
    ];

    /**
     * Defining conversions
     *
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('og')
            ->width(1200)
            ->height(630)
            ->sharpen(100)
            ->nonQueued();
    }

    /**
     * Defining media collections
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('og')
            ->singleFile()
            ->useFallbackUrl(url(config('muetze-site.open-graph.fallback-image', 'img/fallback.jpg')))
            ->useFallbackPath(public_path(config('muetze-site.open-graph.fallback-image', 'img/fallback.jpg')));
    }

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::updated(function ($site) {
            try {
                if (count(array_diff($site->getOriginal(), $site->getAttributes()))) {
                    Artisan::call('sitemap');
                }
            } catch (\Exception $exception) {
                Log::error($exception);
                $this->sendTelegramMessage($exception);
            }
        });
    }
}
