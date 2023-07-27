<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class kategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama'
    ];

    public function post(): HasMany
    {
        return $this->hasMany(post::class);
    }
}
