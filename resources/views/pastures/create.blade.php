@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-800 mb-8">Neue Koppel anlegen</h1>

            <div class="bg-white shadow-xl rounded-xl p-8">
                <form action="{{ route('pastures.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2 text-lg">Name der Koppel</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition @error('name') border-red-500 @enderror"
                            placeholder="z.B. Große Wiese" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 font-bold mb-2 text-lg">Kapazität (Anzahl Pferde)</label>
                        <input type="number" name="capacity" value="{{ old('capacity') }}" min="1"
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition @error('capacity') border-red-500 @enderror"
                            placeholder="z.B. 8" required>
                        @error('capacity')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit"
                            class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition">
                            Speichern
                        </button>
                        <a href="{{ route('pastures.index') }}"
                            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg text-center shadow-lg transform hover:scale-105 transition">
                            Abbrechen
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection