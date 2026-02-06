<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pferde-Turnout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    {{-- Navigation --}}
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex space-x-4 items-center">
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 font-medium">Dashboard</a>
                    <a href="{{ route('horses.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Pferde</a>
                    <a href="{{ route('owners.index') }}"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2">Einsteller</a>
                    <a href="{{ route('pastures.index') }}"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2">Koppeln</a>
                    <a href="{{ route('duties.index') }}"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2">Dienstplan</a>
                    <a href="{{ route('turnout-logs.index') }}"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2">Historie</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>
</body>

</html>