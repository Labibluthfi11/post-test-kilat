@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="max-w-md mx-auto bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
    <h2 class="text-2xl font-bold text-slate-950 text-center">Login Admin</h2>
    <p class="text-slate-500 text-center text-sm mt-1">Masukkan kredensial untuk mengakses dashboard.</p>

    <form action="{{ route('admin.login.submit') }}" method="POST" class="mt-8 space-y-5">
        @csrf
        <div>
            <label for="username" class="block text-sm font-semibold text-slate-700 mb-1">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" 
                class="block w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
        </div>
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
            <input type="password" id="password" name="password" 
                class="block w-full rounded-lg border border-slate-300 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
        </div>
        <button type="submit" 
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg text-sm shadow-md transition">
            Login
        </button>
    </form>
</div>
@endsection
