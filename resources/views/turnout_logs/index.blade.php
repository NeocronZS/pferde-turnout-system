@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">📜 Turnout-Historie</h1>

            {{-- Datum-Filter --}}
            <form method="GET" action="{{ route('turnout-logs.index') }}" class="flex gap-2 items-center">
                <input type="date" name="date" value="{{ request('date') }}"
                    class="border-2 border-gray-300 rounded-lg px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow-lg transform hover:scale-105 transition">
                    Filtern
                </button>
                @if(request('date'))
                    <a href="{{ route('turnout-logs.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-lg shadow-lg transform hover:scale-105 transition">
                        Zurücksetzen
                    </a>
                @endif
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-indigo-500 to-indigo-600">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Datum</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Pferd</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Einsteller
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Rausgebracht
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Reingeholt
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Dauer</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white uppercase tracking-wider">Dienst</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($logs as $log)
                        <tr class="hover:bg-indigo-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-lg font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($log->brought_out_at)->format('d.m.Y') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-semibold text-gray-900">{{ $log->horse->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">{{ $log->horse->owner->name }}</div>
                                <div class="text-xs text-gray-500">{{ $log->horse->owner->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($log->brought_out_at)->format('H:i') }} Uhr
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($log->brought_in_at)
                                    <div class="text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($log->brought_in_at)->format('H:i') }} Uhr
                                    </div>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        🌿 Noch draußen
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($log->brought_in_at)
                                    @php
                                        $duration = \Carbon\Carbon::parse($log->brought_out_at)
                                            ->diffInMinutes(\Carbon\Carbon::parse($log->brought_in_at));
                                        $hours = floor($duration / 60);
                                        $minutes = $duration % 60;
                                    @endphp
                                    <div class="text-sm text-gray-700">
                                        {{ $hours }}h {{ $minutes }}min
                                    </div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $log->duty ? $log->duty->person_name : '-' }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-xl font-medium">Noch keine Einträge vorhanden.</p>
                                    <p class="text-sm text-gray-500 mt-2">Sobald Pferde raus- und reingebracht werden,
                                        erscheinen sie hier.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($logs->hasPages())
                <div class="px-6 py-4 border-t bg-gray-50">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection