@extends('layouts.app')

@section('title', 'Mulai Post-Test')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <h1 class="text-3xl font-extrabold text-slate-950">Selamat Datang</h1>
        <p class="text-slate-500 mt-2 mb-8">Silakan isi data diri untuk memulai post-test.</p>

        <form action="{{ route('quiz.start') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="name" class="w-full bg-slate-50 border-0 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-indigo-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Departemen</label>
                <select name="department" class="w-full bg-slate-50 border-0 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">Pilih Departemen</option>
                    @foreach(['Produksi', 'HRGA', 'IT', 'Finance', 'Sales', 'Warehouse'] as $dept)
                        <option value="{{ $dept }}">{{ $dept }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Materi Training</label>
                <select name="training_material" class="w-full bg-slate-50 border-0 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">Pilih Materi</option>
                    @foreach($materials as $material)
                        <option value="{{ $material }}">{{ $material }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-2xl hover:bg-indigo-700 transition">Mulai Ujian</button>
        </form>
    </div>
</div>
@endsection
