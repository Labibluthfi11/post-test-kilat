@extends('layouts.app')

@section('title', 'Detail Hasil Ujian')

@section('content')
<style>
    @media print {
        header, footer, .no-print { display: none !important; }
        body { background: white !important; }
        .max-w-2xl { max-width: 100% !important; }
    }
</style>

<div class="space-y-6">
    <!-- Header Detail -->
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col sm:flex-row justify-between items-start gap-4">
        <div>
            <h2 class="text-2xl font-bold mb-4">Detail Hasil Ujian: {{ $result->name }}</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                <div><span class="block text-slate-500">Nama</span><span class="font-bold">{{ $result->name }}</span></div>
                <div><span class="block text-slate-500">Departemen</span><span class="font-bold">{{ $result->department }}</span></div>
                <div><span class="block text-slate-500">Skor</span><span class="font-bold text-indigo-600">{{ $result->score }}</span></div>
                <div><span class="block text-slate-500">Status</span><span class="font-bold {{ $result->status === 'Lulus' ? 'text-green-600' : 'text-red-600' }}">{{ $result->status }}</span></div>
            </div>
        </div>

        <!-- Tombol Export -->
        <div class="flex gap-2 no-print">
            <button onclick="window.print()" class="bg-slate-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-700">Print/PDF</button>
            <button onclick="exportTableToExcel('detailTable', 'Detail-Ujian-{{ $result->name }}')" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700">Export Excel</button>
        </div>
    </div>

    <!-- Tabel Detail Jawaban -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm" id="detailTable">
            <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Pertanyaan</th>
                    <th class="px-6 py-3">Jawaban Karyawan</th>
                    <th class="px-6 py-3">Kunci Jawaban</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($result->answers as $ans)
                    <tr class="{{ $ans['is_correct'] ? 'bg-green-50/30' : 'bg-red-50/30' }}">
                        <td class="px-6 py-4">{{ $ans['question'] }}</td>
                        <td class="px-6 py-4">{{ $ans['user_answer'] }}</td>
                        <td class="px-6 py-4 font-bold">{{ $ans['correct_answer'] }}</td>
                        <td class="px-6 py-4 font-bold {{ $ans['is_correct'] ? 'text-green-600' : 'text-red-600' }}">
                            {{ $ans['is_correct'] ? 'Benar' : 'Salah' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Script Export -->
<script class="no-print">
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

