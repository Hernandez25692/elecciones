<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100">
            Actas Registradas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="w-full px-2 md:px-4 lg:px-6">

            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-lg rounded-2xl p-6">

                @if (session('success'))
                    <div class="mb-4 p-3 bg-emerald-100 text-emerald-800 rounded-lg border border-emerald-200">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ============================== -->
                <!--            FILTROS            -->
                <!-- ============================== -->

                <form method="GET"
                    class="mb-6 bg-gray-50 dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <!-- Mesa -->
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Mesa</label>
                            <input type="text" name="mesa" value="{{ request('mesa') }}"
                                placeholder="Ej. 7208"
                                class="w-full mt-1 rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-400">
                        </div>

                        <!-- Nivel -->
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Nivel</label>
                            <select name="nivel"
                                class="w-full mt-1 rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-400">
                                <option value="">Todos</option>
                                <option value="alcalde" {{ request('nivel') == 'alcalde' ? 'selected' : '' }}>Alcalde</option>
                                <option value="presidencial" {{ request('nivel') == 'presidencial' ? 'selected' : '' }}>Presidencial</option>
                            </select>
                        </div>

                        <!-- Búsqueda -->
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Búsqueda</label>
                            <input type="text" name="buscar" value="{{ request('buscar') }}"
                                placeholder="Mesa, usuario, nivel..."
                                class="w-full mt-1 rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <button
                            class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg shadow">
                            Aplicar Filtros
                        </button>

                        <a href="{{ route('actas.index') }}"
                            class="text-red-600 hover:underline">
                            Limpiar filtros
                        </a>
                    </div>
                </form>

                <!-- ============================== -->
                <!--      CABECERA Y BOTÓN         -->
                <!-- ============================== -->

                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        Resultados:
                        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-800 rounded-full text-gray-700 dark:text-gray-200 text-sm">
                            {{ $actas->total() }}
                        </span>
                    </h3>

                    <a href="{{ route('actas.create') }}"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-xl shadow">
                        Nueva Acta
                    </a>
                </div>

                <!-- ============================== -->
                <!--          TABLA FULL           -->
                <!-- ============================== -->

                <div class="w-full overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow">
                    <table class="w-full text-sm md:text-base">

                        <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="p-3">ID</th>
                                <th class="p-3">Mesa</th>
                                <th class="p-3">Nivel</th>
                                <th class="p-3">Votos</th>
                                <th class="p-3">Usuario</th>
                                <th class="p-3">Acta</th>
                                <th class="p-3">Fecha</th>
                                <th class="p-3">Opciones</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse ($actas as $acta)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">

                                    <!-- ID -->
                                    <td class="p-3 font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $acta->id }}
                                    </td>

                                    <!-- MESA -->
                                    <td class="p-3">
                                        <div class="text-gray-800 dark:text-gray-200 font-medium">
                                            {{ $acta->mesa->codigo }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $acta->mesa->departamento }}
                                        </div>
                                    </td>

                                    <!-- NIVEL -->
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                                            @if($acta->nivel === 'presidencial') bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-200
                                            @elseif($acta->nivel === 'alcalde') bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-200
                                            @else bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-200 @endif">
                                            {{ ucfirst($acta->nivel) }}
                                        </span>
                                    </td>

                                    <!-- VOTOS (VERTICAL Y LIMPIO) -->
                                    <td class="p-3">
                                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-7 gap-3">
                                            @php
                                                $parties = [
                                                    ['key'=>'nacional','img'=>'NACIONAL.jpg','label'=>'Nacional'],
                                                    ['key'=>'liberal','img'=>'LIBERAL.jpg','label'=>'Liberal'],
                                                    ['key'=>'libre','img'=>'LIBRE.jpg','label'=>'Libre'],
                                                    ['key'=>'dc','img'=>'DC.jpg','label'=>'DC'],
                                                    ['key'=>'pinu','img'=>'PINU.jpg','label'=>'PINU'],
                                                    ['key'=>'nulos','img'=>'NULOS.jpg','label'=>'Nulos'],
                                                    ['key'=>'blancos','img'=>'BLANCO.jpg','label'=>'Blancos'],
                                                ];
                                            @endphp

                                            @foreach ($parties as $p)
                                                <div class="flex flex-col items-center">
                                                    <img src="{{ asset('storage/logos/'.$p['img']) }}"
                                                        class="h-7 w-7 rounded shadow">
                                                    <span class="mt-1 font-semibold text-gray-800 dark:text-gray-200">
                                                        {{ $acta->{$p['key']} }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>

                                    <!-- USUARIO -->
                                    <td class="p-3 text-gray-800 dark:text-gray-200">
                                        {{ $acta->user->name }}
                                    </td>

                                    <!-- ARCHIVO -->
                                    <td class="p-3">
                                        @if ($acta->archivo)
                                            <a href="{{ asset('storage/'.$acta->archivo) }}" target="_blank"
                                                class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">
                                                Ver
                                            </a>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>

                                    <!-- FECHA -->
                                    <td class="p-3 text-gray-700 dark:text-gray-300">
                                        {{ $acta->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <!-- OPCIONES -->
                                    <td class="p-3">
                                        @if (auth()->user()->role === 'admin')
                                            <a href="{{ route('actas.edit', $acta->id) }}"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow text-sm">
                                                Editar
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-xs">Sin permisos</span>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-6 text-center text-gray-500 dark:text-gray-400">
                                        No se encontraron actas.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-center">
                    {{ $actas->links() }}
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
