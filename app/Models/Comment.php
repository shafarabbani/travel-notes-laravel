<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = false;

    const CREATED_AT = 'created_at';

    protected $fillable = [
        'travel_note_id',
        'author',
        'comment_text',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * A comment belongs to a travel note.
     */
    public function travelNote()
    {
        return $this->belongsTo(TravelNote::class);
    }
}
