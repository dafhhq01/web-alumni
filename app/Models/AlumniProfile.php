<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlumniProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'full_name',
        'angkatan',
        'graduation_year',
        'phone_number',
        'current_job',
        'company',
        'address',
        'social_media_links',
        'profile_picture_path',
        'is_verified',
        'is_private',
        'has_business',
        'business_name',
        'business_type',
        'business_photo',
        'business_description',
    ];

    protected $casts = [
        'social_media_links' => 'array',
        'has_business' => 'boolean',
        'is_verified'        => 'boolean',
        'is_private'         => 'boolean',
    ];

    // RELATIONSHIPS

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // HELPER METHODS

    public function getProfilePictureUrlAttribute(): string
    {
        if ($this->profile_picture_path) {
            return asset('storage/' . $this->profile_picture_path);
        }
        return asset('images/default-avatar.png');
    }
}
