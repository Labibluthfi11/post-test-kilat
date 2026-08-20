@extends('layouts.app')

@section('title', 'Dashboard Admin - Rekapitulasi Nilai')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200 p-5 rounded-xl shadow-sm">
            <span class="block text-xs font-bold text-slate-500 uppercase">Total Peserta</span>
            <span class="text-3xl font-black text-slate-900">{{ $totalParticipants }}</span>
        </div>
        <div class="bg-white border border-slate-200 p-5 rounded-xl shadow-sm">
            <span class="block text-xs font-bold text-green-600 uppercase">Lulus</span>
            <span class="text-3xl font-black text-green-700">{{ $totalLulus }}</span>
        </div>
        <div class="bg-white border border-slate-200 p-5 rounded-xl shadow-sm">
            <span class="block text-xs font-bold text-red-600 uppercase">Tidak Lulus</span>
            <span class="text-3xl font-black text-red-700">{{ $totalTidakLulus }}</span>
        </div>
        <div class="bg-white border border-slate-200 p-5 rounded-xl shadow-sm">
            <span class="block text-xs font-bold text-blue-600 uppercase">Rata-rata Skor</span>
            <span class="text-3xl font-black text-blue-700">{{ $averageScore }}</span>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="font-bold text-slate-900">Rekapitulasi Hasil Ujian Karyawan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-100">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Departemen</th>
                        <th class="px-6 py-3">Materi</th>
                        <th class="px-6 py-3">Skor</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($results as $result)
                        <tr>
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $result->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $result->department }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $result->training_material }}</td>
                            <td class="px-6 py-4 font-bold text-blue-600">{{ $result->score }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold 
                                    {{ $result->status === 'Lulus' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $result->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data ujian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
