<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $fillable = [];

    //relationship with other model
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
