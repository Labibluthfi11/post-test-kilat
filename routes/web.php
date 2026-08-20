<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Route untuk Ujian / Post-Test Karyawan
Route::get('/', [QuizController::class, 'index'])->name('quiz.index');
Route::post('/quiz-start', [QuizController::class, 'start'])->name('quiz.start');
Route::get('/quiz', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/result/{id}', [QuizController::class, 'result'])->name('quiz.result');

// Route untuk Admin Panel (Proteksi Session Manual)
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Route Kelola Soal oleh Admin
Route::get('/admin/questions', [App\Http\Controllers\Admin\QuestionController::class, 'index'])->name('admin.questions.index');
Route::get('/admin/questions/create', [App\Http\Controllers\Admin\QuestionController::class, 'create'])->name('admin.questions.create');
Route::post('/admin/questions', [App\Http\Controllers\Admin\QuestionController::class, 'store'])->name('admin.questions.store');
Route::delete('/admin/questions/{question}', [App\Http\Controllers\Admin\QuestionController::class, 'destroy'])->name('admin.questions.destroy');
