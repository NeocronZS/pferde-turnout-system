@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50">
    <div class="container mx-auto px-4 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">🐴 Pferde-Turnout Dashboard</h1>
            <p class="text-gray-600">{{ \Carbon\Carbon::now()->setTimezone('Europe/Berlin')->locale('de')->isoFormat('dddd, D. MMMM YYYY') }}</p>
        </div>

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg shadow-md mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg shadow-md mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Statistiken --}}
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pferde gesamt</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['total_horses'] }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Draußen</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['horses_outside'] }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Drinnen</p>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['horses_inside'] }}</p>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Einsteller</p>
                        <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['total_owners'] }}</p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Koppeln</p>
                        <p class="text-3xl font-bold text-gray-700 mt-2">{{ $stats['total_pastures'] }}</p>
                    </div>
                    <div class="bg-gray-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Heutiger Dienst --}}
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-7 h-7 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Heutiger Dienst
            </h2>
            @if($todayDuty)
                <div class="flex items-center bg-green-50 rounded-lg p-4">
                    <div class="bg-green-500 rounded-full p-3 mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900">{{ $todayDuty->person_name }}</p>
                        <p class="text-sm text-gray-600 mt-1">hat heute Dienst</p>
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                    <p class="text-yellow-800">⚠️ Heute ist kein Dienst eingetragen.</p>
                    <a href="{{ route('duties.create') }}" class="text-blue-600 hover:underline font-medium">Jetzt Dienst eintragen →</a>
                </div>
            @endif
        </div>

        {{-- Pferde-Übersicht --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Pferde draußen --}}
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-green-600 mb-6 flex items-center">
                    <span class="text-3xl mr-2">🌿</span>
                    Draußen ({{ $horsesOutside->count() }})
                </h2>
                <div class="space-y-3">
                    @forelse($horsesOutside as $horse)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex justify-between items-center hover:shadow-md transition">
                            <div>
                                <p class="font-bold text-lg text-gray-800">{{ $horse->name }}</p>
                                <p class="text-sm text-gray-600">{{ $horse->owner->name }}</p>
                            </div>
                            <form action="{{ route('turnout.in', $horse) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition transform hover:scale-105">
                                    Reinholen
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p class="font-medium">Aktuell sind keine Pferde draußen.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Pferde drinnen --}}
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-blue-600 mb-6 flex items-center">
                    <span class="text-3xl mr-2">🏠</span>
                    Drinnen ({{ $horsesInside->count() }})
                </h2>
                <div class="space-y-3">
                    @forelse($horsesInside as $horse)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-center">
                                <div class="flex-1">
                                    <p class="font-bold text-lg text-gray-800">{{ $horse->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $horse->owner->name }}</p>
                                    
                                    @if($horse->box_rest)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 mt-2">
                                            🏥 Boxenruhe
                                        </span>
                                    @endif
                                </div>
                                
                                @if($horse->box_rest)
                                    <div class="text-right ml-4">
                                        <button disabled class="bg-gray-300 text-gray-500 font-semibold px-4 py-2 rounded-lg cursor-not-allowed">
                                            Nicht möglich
                                        </button>
                                        <p class="text-xs text-red-600 mt-1">Wegen Boxenruhe</p>
                                    </div>
                                @else
                                    <form action="{{ route('turnout.out', $horse) }}" method="POST" class="flex gap-2 items-center ml-4">
                                        @csrf
                                        <select name="pasture_id" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
                                            <option value="">Koppel wählen</option>
                                            @foreach($pastures as $pasture)
                                                <option value="{{ $pasture->id }}">{{ $pasture->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition transform hover:scale-105 whitespace-nowrap">
                                            Rausbringen
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <p class="font-medium">Alle Pferde sind draußen! 🎉</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection