@extends('layouts.app')

@section('title', 'Hasil Post-Test - ' . $result->name)

@section('content')
<div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm text-center">
    <!-- Status Icon -->
    <div class="mx-auto w-20 h-20 rounded-full flex items-center justify-center {{ $result->status === 'Lulus' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
        @if($result->status === 'Lulus')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        @endif
    </div>

    <h2 class="text-3xl font-black text-slate-950 mt-6">
        {{ $result->status === 'Lulus' ? 'Selamat, Anda Lulus!' : 'Mohon Maaf, Anda Belum Lulus' }}
    </h2>
    <p class="text-slate-600 mt-2">Hasil post-test untuk materi <strong>{{ $result->training_material }}</strong></p>

    <!-- Score Card -->
    <div class="mt-8 inline-block bg-slate-50 border border-slate-200 rounded-xl px-8 py-6">
        <span class="block text-sm font-semibold text-slate-500 uppercase tracking-wide">Skor Anda</span>
        <span class="text-5xl font-black text-blue-600">{{ $result->score }}</span>
        <span class="text-2xl font-bold text-slate-400">/ 100</span>
    </div>

    <!-- Info Detail -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 text-left max-w-lg mx-auto bg-slate-50 border border-slate-200 p-4 rounded-lg">
        <div>
            <span class="block text-xs text-slate-500 font-semibold">Nama</span>
            <span class="text-sm font-medium text-slate-800">{{ $result->name }}</span>
        </div>
        <div>
            <span class="block text-xs text-slate-500 font-semibold">Departemen</span>
            <span class="text-sm font-medium text-slate-800">{{ $result->department }}</span>
        </div>
    </div>

    <div class="mt-10">
        <a href="{{ route('quiz.index') }}" 
            class="inline-flex items-center space-x-2 bg-slate-800 hover:bg-slate-900 text-white font-bold py-3 px-8 rounded-lg text-sm transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali ke Beranda</span>
        </a>
    </div>
</div>
@endsection
