<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, LogsActivity;
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'status'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    // log activity
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


}
