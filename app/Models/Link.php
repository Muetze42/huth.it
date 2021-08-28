<?php

namespace App\Models;

use App\Helpers\Sitemap;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Artisan;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Link extends Model implements Sortable
{
    use LogsActivity, HasFactory, SoftDeletes, SortableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active',
        'name',
        'target',
        'icon',
        'count',
        'real_count',
        'color',
        'order',
    ];

    public array $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => true,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->dontLogIfAttributesChangedOnly([
                'count',
                'real_count',
            ])->logOnly([
                'active',
                'name',
                'target',
                'icon',
                'color',
                'order',
            ]);
    }

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::created(function () {
            gerateAdditionalStylesheet();
            Artisan::call('sitemap');
        });
        static::updated(function ($link) {
            if ($link->name != $link->getOriginal('name') || $link->target != $link->getOriginal('target')) {
                gerateAdditionalStylesheet();
                Page::find(1)->touch();
                Artisan::call('sitemap');
            }
        });
    }

    /**
     * Get the counts for the link.
     */
    public function counts(): HasMany
    {
        return $this->hasMany(LinkCount::class);
    }

    /**
     * Get the counts for the link.
     */
    public function realCounts(): HasMany
    {
        return $this->hasMany(LinkRealCount::class);
    }
}
