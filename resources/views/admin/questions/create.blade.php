@extends('layouts.app')

@section('title', 'Tambah Soal')

@section('content')
<div class="max-w-2xl mx-auto bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
    <h2 class="text-xl font-bold mb-6">Tambah Soal Baru</h2>
    <form action="{{ route('admin.questions.store') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label class="block text-sm font-semibold mb-1">Pilih Materi (atau ketik baru di bawah)</label>
            <select id="material_select" class="w-full border rounded-lg p-2 mb-2" onchange="document.getElementById('material_input').value = this.value">
                <option value="">-- Pilih dari materi yang ada --</option>
                @foreach($existingMaterials as $mat)
                    <option value="{{ $mat }}">{{ $mat }}</option>
                @endforeach
            </select>
            
            <input type="text" name="material" id="material_input" class="w-full border rounded-lg p-2" required placeholder="Contoh: Sistem Jaminan Halal">
        </div>
        
        <div>
            <label class="block text-sm font-semibold mb-1">Pertanyaan</label>
            <textarea name="question" class="w-full border rounded-lg p-2" required></textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach(['A', 'B', 'C', 'D'] as $opt)
            <div>
                <label class="block text-sm font-semibold mb-1">Opsi {{ $opt }}</label>
                <input type="text" name="options[{{ $opt }}]" class="w-full border rounded-lg p-2" required>
            </div>
            @endforeach
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Kunci Jawaban</label>
            <select name="correct_answer" class="w-full border rounded-lg p-2">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white w-full p-3 rounded-lg font-bold">Simpan Soal</button>
    </form>
</div>
@endsection
