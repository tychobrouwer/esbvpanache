<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Activity extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title_en',
        'title_nl',
        'date',
        'duration',
        'location_en',
        'location_nl',
        'cost_en',
        'cost_nl',
        'join_en',
        'join_nl',
        'content_en',
        'content_nl',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
      		'date' => 'datetime',
            'duration' => 'float',
        ];
    }
}
