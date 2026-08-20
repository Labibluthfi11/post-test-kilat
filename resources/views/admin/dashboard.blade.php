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

    <!-- Filter Bar -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex flex-col sm:flex-row gap-3">
        <input type="text" id="searchInput" placeholder="Cari berdasarkan Nama, Materi, atau Tanggal (YYYY-MM-DD)..." 
               class="flex-grow border border-slate-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        <button onclick="exportTableToExcel('resultsTable', 'Laporan-Rekap-Ujian')" 
                class="bg-green-600 text-white px-4 py-3 rounded-lg text-sm font-semibold hover:bg-green-700">
            Export Excel
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
            <h3 class="font-bold text-slate-900">Rekapitulasi Hasil Ujian Karyawan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" id="resultsTable">
                <thead class="text-xs text-slate-500 uppercase bg-slate-100">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Departemen</th>
                        <th class="px-6 py-3">Materi</th>
                        <th class="px-6 py-3">Skor</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($results as $result)
                        <tr class="result-row">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $result->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $result->department }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $result->training_material }}</td>
                            <td class="px-6 py-4 font-bold text-indigo-600">{{ $result->score }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $result->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold 
                                    {{ $result->status === 'Lulus' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $result->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.results.show', $result->id) }}" class="text-indigo-600 font-semibold hover:underline">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500">Belum ada data ujian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script Filter Live & Export -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('.result-row');
        
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    function exportTableToExcel(tableID, filename){
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        var downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);
        downloadLink.href = 'data:application/vnd.ms-excel,' + tableHTML;
        downloadLink.download = filename + '.xls';
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }
</script>
@endsection
