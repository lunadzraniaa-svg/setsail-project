<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gadget Catalog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">
<nav class="bg-indigo-700 text-white px-6 py-3 flex items-center justify-between shadow">
    <a href="{{ route('gadgets.index') }}" class="text-xl font-bold tracking-wide">🔌 Gadget Catalog</a>
    <a href="{{ route('gadgets.create') }}" class="bg-white text-indigo-700 px-4 py-1.5 rounded font-semibold text-sm hover:bg-indigo-50 transition">+ Add Gadget</a>
</nav>
<main class="max-w-5xl mx-auto px-4 py-8">
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>
