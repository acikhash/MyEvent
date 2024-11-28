<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $fillable = [];

    //relationship with other model
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
    public function title()
    {
        return $this->belongsTo(Title::class);
    }
    // Define the relationship with Assignment
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'staff_id');
    }
}
