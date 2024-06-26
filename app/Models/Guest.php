<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        // 'salutations',
        // 'name',
        // 'organization',
        // 'address',
        // 'contactNumber',
        // 'email',
        // 'guesttype',
        // 'bringrep',
        // 'attendance',
        // 'checkedin',


    ];

    public function event()
    {
        return $this->belongsTo(Event::class,  'event_id', 'id');
    }
}
