@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $currentChapter->title }}</h1>
    <p>{{ $currentChapter->description }}</p>

    @if ($choices->count() > 0)
        <h4>Your choices:</h4>
        <ul>
            @foreach($choices as $choice)
                <li>
                    <form action="{{ route('game.processChoice') }}" method="POST">
                        @csrf
                        <input type="hidden" name="choice_id" value="{{ $choice->id }}">
                        <button type="submit" class="btn btn-primary">
                            {{ $choice->label }}
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No choices available. Maybe this is the end!</p>
    @endif
</div>
@endsection
