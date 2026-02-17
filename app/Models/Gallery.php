<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    // TIDAK pakai SoftDeletes — sesuai keputusan teknis (hard delete)

    protected $fillable = [
        'album_name',
        'image_path',
        'event_year',
        'uploaded_by',
    ];

    protected $casts = [
        'event_year' => 'integer',
    ];

    // RELATIONSHIPS

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // HELPER

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}