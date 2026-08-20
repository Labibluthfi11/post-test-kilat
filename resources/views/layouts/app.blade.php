<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Post-Test')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <div class="bg-indigo-600 p-2 rounded-lg text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <span class="font-bold text-lg tracking-tight"><span class="text-indigo-600">PT ANSEL MUDA BERKARYA</span></span>
            </a>

            <nav class="flex items-center gap-2 sm:gap-4">
                @if(session('admin_logged_in'))
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium hover:text-indigo-600 transition">Dashboard</a>
                    <a href="{{ route('admin.questions.index') }}" class="text-sm font-medium hover:text-indigo-600 transition">Soal</a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">Logout</button>
                    </form>
                @endif
            </nav>
        </div>
    </header>

    <main class="flex-grow w-full max-w-5xl mx-auto px-4 sm:px-6 py-8">
        @yield('content')
    </main>

    <footer class="py-8 text-center text-sm text-slate-400">
        &copy; {{ date('Y') }} HR & IT Dept.
    </footer>
</body>
</html>
