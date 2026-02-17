<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELATIONSHIPS

    public function alumniProfile()
    {
        return $this->hasOne(AlumniProfile::class);
    }

    public function news()
    {
        return $this->hasMany(News::class, 'created_by');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'uploaded_by');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'created_by');
    }

    // HELPER METHODS

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAlumni(): bool
    {
        return $this->role === 'alumni';
    }
}