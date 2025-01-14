<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'ai_prompt',
        'next_chapter_id',
    ];

    public function nextChapter()
    {
        return $this->belongsTo(Chapter::class, 'next_chapter_id');
    }

    /**
     * Relazione con le choices
     * Un capitolo può avere molte scelte
     */
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}