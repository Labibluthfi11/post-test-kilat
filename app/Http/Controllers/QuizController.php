<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Tampilkan form input data peserta.
     */
    public function index()
    {
        // Ambil pilihan materi training secara dinamis dari materi soal yang tersedia
        $materials = Question::select('material')->distinct()->pluck('material');

        return view('quiz.index', compact('materials'));
    }

    /**
     * Proses submit data peserta dan inisialisasi kuis.
     */
    public function start(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|in:Produksi,HRGA,GA,PPIC,Warehouse,Quality and Development,Finance,Purchasing,Sales and Marketing,IT,Manager,Security Fence',
            'training_material' => 'required|string',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'department.required' => 'Departemen wajib dipilih.',
            'department.in' => 'Departemen yang dipilih tidak valid.',
            'training_material.required' => 'Materi training wajib dipilih.',
        ]);

        // Pencegahan Duplikasi: cek apakah Nama + Materi sudah pernah dikerjakan
        $alreadyTaken = QuizResult::where('name', $validated['name'])
            ->where('training_material', $validated['training_material'])
            ->exists();

        if ($alreadyTaken) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Karyawan dengan nama tersebut sudah pernah mengikuti post-test untuk materi training ini.');
        }

        // Cek apakah ada soal untuk materi yang dipilih
        $questionsCount = Question::where('material', $validated['training_material'])->count();
        if ($questionsCount === 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Belum ada bank soal untuk materi training yang Anda pilih.');
        }

        // Simpan data peserta di session
        session(['participant' => $validated]);

        return redirect()->route('quiz.show');
    }

    /**
     * Tampilkan halaman kuis (soal ujian).
     */
    public function show()
    {
        $participant = session('participant');

        if (!$participant) {
            return redirect()->route('quiz.index')
                ->with('error', 'Silakan isi data diri terlebih dahulu.');
        }

        // Ambil soal berdasarkan materi yang dipilih
        $questions = Question::where('material', $participant['training_material'])->get();

        return view('quiz.show', compact('participant', 'questions'));
    }

    /**
     * Hitung nilai otomatis, simpan ke database, dan tampilkan hasil.
     */
    public function submit(Request $request)
    {
        $participant = session('participant');

        if (!$participant) {
            return redirect()->route('quiz.index')
                ->with('error', 'Sesi Anda telah berakhir. Silakan isi data diri kembali.');
        }

        $questions = Question::where('material', $participant['training_material'])->get();

        // Validasi: Pastikan semua soal dijawab
        $rules = [];
        $messages = [];
        foreach ($questions as $question) {
            $rules['answers.' . $question->id] = 'required|string';
            $messages['answers.' . $question->id . '.required'] = 'Semua pertanyaan harus dijawab sebelum mengirim.';
        }

        $request->validate($rules, $messages);

        $answers = $request->input('answers', []);
        $correctCount = 0;
        $totalQuestions = $questions->count();
        $detailedAnswers = [];

        foreach ($questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            $isCorrect = ($userAnswer === $question->correct_answer);

            if ($isCorrect) {
                $correctCount++;
            }

            $detailedAnswers[$question->id] = [
                'question' => $question->question,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->correct_answer,
                'is_correct' => $isCorrect,
                'options' => $question->options
            ];
        }

        // Hitung nilai otomatis (skala 100)
        $score = $totalQuestions > 0 ? (int) round(($correctCount / $totalQuestions) * 100) : 0;

        // KKM 70
        $status = $score >= 70 ? 'Lulus' : 'Tidak Lulus';

        // Simpan ke database
        $result = QuizResult::create([
            'name' => $participant['name'],
            'department' => $participant['department'],
            'training_material' => $participant['training_material'],
            'score' => $score,
            'status' => $status,
            'answers' => $detailedAnswers, // disimpan sebagai json
        ]);

        // Hapus session peserta agar tidak bisa refresh atau back untuk mengulang instan
        session()->forget('participant');

        return redirect()->route('quiz.result', $result->id)
            ->with('success', 'Post-test berhasil dikerjakan!');
    }

    /**
     * Tampilkan halaman hasil kuis.
     */
    public function result($id)
    {
        $result = QuizResult::findOrFail($id);

        return view('quiz.result', compact('result'));
    }
}
