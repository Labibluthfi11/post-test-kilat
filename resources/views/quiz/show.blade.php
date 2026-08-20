@extends('layouts.app')

@section('title', 'Sedang Mengerjakan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <h2 class="text-xl font-bold">{{ $participant['training_material'] }}</h2>
        <span class="bg-indigo-100 text-indigo-700 font-bold px-4 py-2 rounded-full text-sm">
            {{ $questions->count() }} Soal
        </span>
    </div>

    <form action="{{ route('quiz.submit') }}" method="POST" class="space-y-6">
        @csrf
        @foreach($questions as $index => $question)
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm">
                <p class="text-lg font-medium mb-6 text-slate-900">{{ $index + 1 }}. {{ $question->question }}</p>
                <div class="space-y-3">
                    @foreach($question->options as $key => $option)
                        <label class="flex items-center p-4 rounded-2xl border-2 border-slate-100 hover:border-indigo-500 cursor-pointer transition">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $key }}" class="w-5 h-5 text-indigo-600 focus:ring-indigo-500" required>
                            <span class="ml-3 font-medium text-slate-700">{{ $option }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition">Kirim Jawaban</button>
    </form>
</div>
@endsection
