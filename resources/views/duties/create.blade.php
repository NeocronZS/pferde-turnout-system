@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-800 mb-8">Neuen Dienst eintragen</h1>

            <div class="bg-white shadow-xl rounded-xl p-8">
                <form action="{{ route('duties.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2 text-lg">Datum</label>
                        <input type="date" name="date" value="{{ old('date') }}"
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition @error('date') border-red-500 @enderror"
                            required>
                        @error('date')
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
                        <label class="block text-gray-700 font-bold mb-2 text-lg">Person</label>
                        <input type="text" name="person_name" value="{{ old('person_name') }}"
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition @error('person_name') border-red-500 @enderror"
                            placeholder="z.B. Maria Schmidt" required>
                        @error('person_name')
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
                            class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition">
                            Speichern
                        </button>
                        <a href="{{ route('duties.index') }}"
                            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg text-center shadow-lg transform hover:scale-105 transition">
                            Abbrechen
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection