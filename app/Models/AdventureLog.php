<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdventureLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chapter_id',
        'choice_id',
    ];

    /**
     * Relazione con l'utente
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relazione con il capitolo
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    /**
     * Relazione con la choice (se presente)
     */
    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }
}