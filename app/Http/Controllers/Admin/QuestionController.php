<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login.');
        }
        $questions = Question::latest()->get();
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login.');
        }
        $existingMaterials = Question::select('material')->distinct()->pluck('material');
        return view('admin.questions.create', compact('existingMaterials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'material' => 'required|string',
            'question' => 'required|string',
            'options' => 'required|array',
            'correct_answer' => 'required|string'
        ]);

        Question::create($validated);
        return redirect()->route('admin.questions.index')->with('success', 'Soal berhasil ditambah!');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')->with('success', 'Soal dihapus!');
    }
}
