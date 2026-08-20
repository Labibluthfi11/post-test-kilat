@extends('layouts.app')

@section('title', 'Manajemen Soal')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Bank Soal</h2>
    <a href="{{ route('admin.questions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700">Tambah Soal</a>
</div>

<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="text-xs text-slate-500 uppercase bg-slate-100">
            <tr>
                <th class="px-6 py-3">Materi</th>
                <th class="px-6 py-3">Pertanyaan</th>
                <th class="px-6 py-3">Jawaban Benar</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($questions as $question)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $question->material }}</td>
                    <td class="px-6 py-4">{{ Str::limit($question->question, 50) }}</td>
                    <td class="px-6 py-4 font-bold text-green-600">{{ $question->correct_answer }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
