<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resanction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sanctionable()
    {
        return $this->morphTo();
    }

    public function year() {
        return $this->belongsTo(Year::class);
    }
}
