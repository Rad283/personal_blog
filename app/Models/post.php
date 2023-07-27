<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class post extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'thumbnail', 'kategori_id', 'postingan'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(kategori::class);
    }
}
