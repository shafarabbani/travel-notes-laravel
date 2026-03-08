<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'location',
        'country',
        'date',
        'experience',
        'mood',
        'photo',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * The travel note belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A travel note has many comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
