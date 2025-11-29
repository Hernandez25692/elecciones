<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Editar Acta #{{ $acta->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-200 text-green-900 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('actas.update', $acta->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Mesa -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">Número de Mesa</label>
                        <input type="text" name="mesa_codigo" value="{{ $acta->mesa->codigo }}"
                            class="w-full rounded border-gray-300 dark:bg-gray-800 dark:text-gray-200" required>
                    </div>

                    <!-- Nivel -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">Nivel Electoral</label>
                        <select name="nivel"
                            class="w-full rounded border-gray-300 dark:bg-gray-800 dark:text-gray-200">
                            <option value="alcalde" {{ $acta->nivel == 'alcalde' ? 'selected' : '' }}>Alcalde</option>
                            <option value="presidencial" {{ $acta->nivel == 'presidencial' ? 'selected' : '' }}>
                                Presidencial</option>
                        </select>
                    </div>

                    <!-- Archivo -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                            Archivo del Acta (opcional)
                        </label>

                        @if ($acta->archivo)
                            <p class="text-sm text-blue-500 dark:text-blue-400 mb-2">
                                Archivo actual:
                                <a href="{{ asset('storage/' . $acta->archivo) }}" target="_blank" class="underline">
                                    Ver archivo
                                </a>
                            </p>
                        @endif

                        <input type="file" name="archivo"
                            class="w-full text-gray-700 dark:text-gray-200 dark:bg-gray-800 border-gray-300 rounded">
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">
                        Votos por Partido
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        @php
                            $partidos = [
                                'nacional' => 'NACIONAL.jpg',
                                'liberal' => 'LIBERAL.jpg',
                                'libre' => 'LIBRE.jpg',
                                'dc' => 'DC.jpg',
                                'pinu' => 'PINU.jpg',
                                'nulos' => 'NULOS.jpg',
                                'blancos' => 'BLANCO.jpg',
                            ];
                        @endphp

                        @foreach ($partidos as $campo => $imagen)
                            <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded shadow">
                                <img src="{{ asset('storage/logos/' . $imagen) }}" class="h-20 mx-auto mb-2 rounded">
                                <p class="text-center font-semibold text-gray-700 dark:text-gray-300">
                                    {{ strtoupper($campo) }}
                                </p>
                                <input type="number" name="{{ $campo }}" value="{{ $acta->$campo }}"
                                    class="w-full mt-2 rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                                    placeholder="Votos">
                            </div>
                        @endforeach

                    </div>

                    <button class="mt-6 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Actualizar Acta
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
