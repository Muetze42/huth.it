<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
