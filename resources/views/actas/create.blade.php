<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Registrar Acta Electoral
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
                @if (session('error'))
                    <div class="mb-4 p-3 bg-red-200 text-red-900 rounded font-semibold">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('actas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Mesa -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">Número de Mesa</label>
                        <input type="text" name="mesa_codigo" placeholder="Ej: 7208"
                            class="w-full rounded border-gray-300 dark:bg-gray-800 dark:text-gray-200" required>
                    </div>

                    <!-- Nivel Electoral -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">Nivel Electoral</label>
                        <select name="nivel"
                            class="w-full rounded border-gray-300 dark:bg-gray-800 dark:text-gray-200">
                            <option value="alcalde">Alcalde</option>
                            <option value="presidencial">Presidencial</option>
                        </select>
                    </div>

                    <!-- Archivo Acta -->
                    <div class="mb-6">
                        <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                            Foto del Acta (opcional)
                        </label>
                        <input type="file" name="archivo"
                            class="w-full text-gray-700 dark:text-gray-200 dark:bg-gray-800 border-gray-300 rounded">
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">
                        Votos por Partido
                    </h3>

                    <!-- Grid de partidos -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        <!-- Partido Nacional -->
                        <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded shadow">
                            <img src="{{ asset('storage/logos/NACIONAL.jpg') }}" class="h-20 mx-auto mb-2 rounded">
                            <p class="text-center font-semibold text-gray-700 dark:text-gray-300">Partido Nacional</p>
                            <input type="number" name="nacional"
                                class="w-full mt-2 rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                                placeholder="Votos">
                        </div>

                        <!-- Partido Liberal -->
                        <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded shadow">
                            <img src="{{ asset('storage/logos/LIBERAL.jpg') }}" class="h-20 mx-auto mb-2 rounded">
                            <p class="text-center font-semibold text-gray-700 dark:text-gray-300">Partido Liberal</p>
                            <input type="number" name="liberal"
                                class="w-full mt-2 rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                                placeholder="Votos">
                        </div>

                        <!-- LIBRE -->
                        <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded shadow">
                            <img src="{{ asset('storage/logos/LIBRE.jpg') }}" class="h-20 mx-auto mb-2 rounded">
                            <p class="text-center font-semibold text-gray-700 dark:text-gray-300">LIBRE</p>
                            <input type="number" name="libre"
                                class="w-full mt-2 rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                                placeholder="Votos">
                        </div>

                        <!-- Democracia Cristiana (DC) -->
                        <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded shadow">
                            <img src="{{ asset('storage/logos/DC.jpg') }}" class="h-20 mx-auto mb-2 rounded">
                            <p class="text-center font-semibold text-gray-700 dark:text-gray-300">Democracia Cristiana
                            </p>
                            <input type="number" name="dc"
                                class="w-full mt-2 rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                                placeholder="Votos">
                        </div>

                        <!-- PINU -->
                        <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded shadow">
                            <img src="{{ asset('storage/logos/PINU.jpg') }}" class="h-20 mx-auto mb-2 rounded">
                            <p class="text-center font-semibold text-gray-700 dark:text-gray-300">PINU</p>
                            <input type="number" name="pinu"
                                class="w-full mt-2 rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                                placeholder="Votos">
                        </div>

                        <!-- Nulos -->
                        <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded shadow">
                            <img src="{{ asset('storage/logos/NULOS.jpg') }}" class="h-20 mx-auto mb-2 rounded">
                            <p class="text-center font-semibold text-gray-700 dark:text-gray-300">Votos Nulos</p>
                            <input type="number" name="nulos"
                                class="w-full mt-2 rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                                placeholder="Votos">
                        </div>

                        <!-- Blancos -->
                        <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded shadow">
                            <img src="{{ asset('storage/logos/BLANCO.jpg') }}" class="h-20 mx-auto mb-2 rounded">
                            <p class="text-center font-semibold text-gray-700 dark:text-gray-300">Votos en Blanco</p>
                            <input type="number" name="blancos"
                                class="w-full mt-2 rounded border-gray-300 dark:bg-gray-900 dark:text-gray-200"
                                placeholder="Votos">
                        </div>

                    </div>

                    <!-- Botón -->
                    <button class="mt-6 bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
                        Guardar Acta
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
