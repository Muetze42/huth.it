<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Repository
 *
 * @property int $id
 * @property string $package
 * @property string $description
 * @property string $reference
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerApiClient[] $customerApiClients
 * @property-read int|null $customer_api_clients_count
 * @method static \Illuminate\Database\Eloquent\Builder|Repository newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Repository newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Repository query()
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository wherePackage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $branch
 * @method static \Illuminate\Database\Eloquent\Builder|Repository whereBranch($value)
 */
class Repository extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'package',
        'branch',
        'description',
        'reference',
    ];

    /**
     * The Customer API Clients that belong to the client.
     */
    public function customerApiClients(): BelongsToMany
    {
        return $this->belongsToMany(CustomerApiClient::class);
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted()
    {
        static::saving(function ($repo) {
            $repo->package = basename($repo->package);
        });
    }
}
