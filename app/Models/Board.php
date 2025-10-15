<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Board extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'year',
        'chairperson',
        'vice_chairperson',
        'secretary',
        'treasurer',
        'slogan',
        'message_en',
        'message_nl',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
      		'year' => 'integer',
        ];
    }
}
