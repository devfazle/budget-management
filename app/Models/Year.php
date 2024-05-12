<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rquisition() {
        return $this->hasMany(Requisition::class);
    }

    public function sanction() {
        return $this->hasMany(Sanction::class);
    }

    public function resanctionRequest() {
        return $this->hasMany(ResanctionRequest::class);
    }

    public function resanction() {
        return $this->hasMany(Resanction::class);
    }
}
