<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chapter;
use App\Models\Choice;
use App\Models\AdventureLog;

class GameController extends Controller
{
    /**
     * Mostra il capitolo attuale dell'utente
     */
    public function showCurrentChapter()
    {
        // 1) Recupera l'utente loggato
        $user = Auth::user();

        // 2) Verifica l'ultimo log dell'utente
        $lastLog = AdventureLog::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->first();

        // Se l'utente non ha un log, significa che non ha ancora iniziato
        if (!$lastLog) {
            return redirect()->route('game.start');
        }

        // 3) Recupera il capitolo corrispondente
        $currentChapter = Chapter::find($lastLog->chapter_id);

        // 4) Recupera le scelte collegate a questo capitolo
        $choices = $currentChapter->choices;

        // 5) Ritorna una vista (o JSON se usi Vue separato) con i dati
        return view('game.current-chapter', compact('currentChapter', 'choices'));
    }

    /**
     * Inizializza l’avventura (capitolo iniziale = ID 1, ad esempio)
     */
    public function start()
    {
        $user = Auth::user();

        // Se vuoi definire ID=1 come capitolo iniziale (o ricavarlo da config)
        $firstChapterId = 1;

        // Crea un log che indica che l'utente inizia dal capitolo 1
        AdventureLog::create([
            'user_id' => $user->id,
            'chapter_id' => $firstChapterId,
        ]);

        return redirect()->route('game.current');
    }

    /**
     * Gestisce la scelta fatta dall'utente
     */
    public function processChoice(Request $request)
    {
        $user = Auth::user();
        $choiceId = $request->input('choice_id');

        // 1) Troviamo la choice
        $choice = Choice::findOrFail($choiceId);

        // 2) Salviamo nel log la scelta
        AdventureLog::create([
            'user_id'   => $user->id,
            'chapter_id'=> $choice->chapter_id,
            'choice_id' => $choice->id,
        ]);

        // 3) Se la choice punta a un capitolo successivo, ci entriamo
        if ($choice->next_chapter_id) {
            AdventureLog::create([
                'user_id'   => $user->id,
                'chapter_id'=> $choice->next_chapter_id
            ]);
        }

        return redirect()->route('game.current');
    }
}
