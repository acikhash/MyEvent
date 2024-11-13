<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $fillable = [];

    //relationship with other model
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
