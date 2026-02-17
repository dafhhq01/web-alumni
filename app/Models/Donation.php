<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'target_amount',
        'collected_amount',
        'bank_details',
        'status',
        'created_by',
    ];

    protected $casts = [
        'target_amount'    => 'decimal:2',
        'collected_amount' => 'decimal:2',
    ];

    // RELATIONSHIPS

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // SCOPES

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // HELPER

    public function getProgressPercentageAttribute(): int
    {
        if ($this->target_amount <= 0) return 0;
        return min(100, (int) (($this->collected_amount / $this->target_amount) * 100));
    }
}