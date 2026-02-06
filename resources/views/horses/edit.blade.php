@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Pferd bearbeiten</h1>

        <div class="bg-white shadow-xl rounded-xl p-8">
            <form action="{{ route('horses.update', $horse) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2 text-lg">Name des Pferdes</label>
                    <input type="text" name="name" value="{{ old('name', $horse->name) }}" 
                           class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('name') border-red-500 @enderror" 
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2 text-lg">Geschlecht</label>
                    <select name="gender" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                        <option value="">-- Optional --</option>
                        <option value="Stute" {{ old('gender', $horse->gender) == 'Stute' ? 'selected' : '' }}>Stute</option>
                        <option value="Wallach" {{ old('gender', $horse->gender) == 'Wallach' ? 'selected' : '' }}>Wallach</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="box_rest" value="1" 
                               {{ old('box_rest', $horse->box_rest) ? 'checked' : '' }}
                               class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <span class="ml-3 text-gray-700 font-bold text-lg">🏥 Boxenruhe</span>
                    </label>
                    <p class="text-sm text-gray-500 mt-1 ml-8">Pferd darf nicht auf die Koppel</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2 text-lg">Box-Nummer (optional)</label>
                    <input type="text" name="box_number" value="{{ old('box_number', $horse->box_number) }}" 
                           class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" 
                           placeholder="z.B. B12">
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-bold mb-2 text-lg">Einsteller</label>
                    <select name="owner_id" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition @error('owner_id') border-red-500 @enderror" required>
                        <option value="">-- Bitte wählen --</option>
                        @foreach($owners as $owner)
                            <option value="{{ $owner->id }}" {{ old('owner_id', $horse->owner_id) == $owner->id ? 'selected' : '' }}>
                                {{ $owner->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('owner_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition">
                        Aktualisieren
                    </button>
                    <a href="{{ route('horses.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg text-center shadow-lg transform hover:scale-105 transition">
                        Abbrechen
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection