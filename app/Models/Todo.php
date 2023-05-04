<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_completed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAuthUser(Builder $query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeCompleted(Builder $query)
    {
        return $query->where('is_completed', true);
    }

    public function scopeIncomplete(Builder $query)
    {
        return $query->where('is_completed', false);
    }
}
