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

    /**
     * Get a string representation of the board members.
     */
    public function string() {
        return
            current(explode(" ", $this->chairperson)) . ", " .
            current(explode(" ", $this->vice_chairperson)) . ", " .
            current(explode(" ", $this->secretary)) . ", " .
            current(explode(" ", $this->treasurer));
    }

    /**
     * Get the ordinal representation of the board year.
     */
    public function ordinal() {
        $number = $this->year;
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');

        if ((($number % 100) >= 11) && (($number%100) <= 13)) {
            return $number. 'th';
        } else {
            return $number. $ends[$number % 10];
        }
    }

    public function chairpersonShort() {
        return current(explode(" ", $this->chairperson));
    }

    public function viceChairpersonShort() {
        return current(explode(" ", $this->vice_chairperson));
    }

    public function secretaryShort() {
        return current(explode(" ", $this->secretary));
    }

    public function treasurerShort() {
        return current(explode(" ", $this->treasurer));
    }
}
