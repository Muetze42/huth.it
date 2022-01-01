<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ContactRequest
 *
 * @property int $id
 * @property string $subject
 * @property string $message
 * @property string $email
 * @property string $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest newQuery()
 * @method static \Illuminate\Database\Query\Builder|ContactRequest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ContactRequest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ContactRequest withoutTrashed()
 * @mixin \Eloquent
 */
class ContactRequest extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_OPEN = 0;
    const STATUS_SENT = 1;
    const STATUS_REJECTED = 2;

    const STATUS_ICONS = [
        0 => 'fa-question-circle',
        1 => 'fas fa-mailbox',
        2 => 'fa-times-circle',
    ];

    const STATUS_COLORS = [
        0 => 'text-primary',
        1 => 'text-success',
        2 => 'text-danger',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'message',
        'email',
        'name',
        'status',
    ];
}
