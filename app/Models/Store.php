<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Store extends Model
{
    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'stores';
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'logo',
        'banner',
        'ktp_number',
        'ktp_image',
        'approval_status',
        'message',
        'status',
        'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean'
    ];


    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    // Log Activity
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Category has been {$eventName}";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('category')
            ->logAll()
            ->logOnlyDirty();
    }

    // Relation
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
