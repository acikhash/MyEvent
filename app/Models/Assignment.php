<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $fillable = [];

    //relationship with other model
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
