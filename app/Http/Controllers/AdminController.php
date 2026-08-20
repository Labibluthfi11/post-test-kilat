<?php

namespace App\Http\Controllers;

use App\Models\QuizResult;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Tampilkan form login admin.
     */
    public function loginForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Proses login admin.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Hardcode credential: admin / admin123
        if ($username === 'admin' && $password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
        }

        return redirect()->back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau Password salah!');
    }

    /**
     * Tampilkan Dashboard Admin (Rekapitulasi Nilai).
     */
    public function dashboard()
    {
        // Proteksi session manual
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu untuk mengakses dashboard.');
        }

        // Ambil data hasil ujian terbaru dan urutkan berdasarkan nama
        $results = QuizResult::orderBy('name', 'asc')->get();

        // Hitung rekapitulasi data statistik
        $totalParticipants = $results->count();
        $totalLulus = $results->where('status', 'Lulus')->count();
        $totalTidakLulus = $results->where('status', 'Tidak Lulus')->count();
        $averageScore = $totalParticipants > 0 ? (int) round($results->avg('score')) : 0;

        return view('admin.dashboard', compact(
            'results',
            'totalParticipants',
            'totalLulus',
            'totalTidakLulus',
            'averageScore'
        ));
    }

    /**
     * Logout admin.
     */
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
