<x-app-layout>

    {{-- ========================= --}}
    {{-- ENCABEZADO --}}
    {{-- ========================= --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-3xl bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
                    🗳️ Centro de Resultados Electorales
                </h2>
                <p class="text-gray-300 text-sm mt-2">Dashboard en Tiempo Real • Monitoreo Electoral Nacional</p>
            </div>
            <div class="flex items-center gap-3">
                <span
                    class="inline-flex items-center gap-2 px-3 py-1 bg-green-500/20 border border-green-500/30 rounded-full text-green-300 text-sm">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    SISTEMA ACTIVO
                </span>
            </div>
        </div>
    </x-slot>

    {{-- Fondo general elegante --}}
    <div class="py-8 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ========================================================= --}}
            {{-- TARJETAS RESUMEN --}}
            {{-- ========================================================= --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                {{-- Mesas procesadas --}}
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-300">
                    </div>
                    <div
                        class="relative p-6 rounded-2xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 transform transition-all duration-300 group-hover:scale-105">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                                <i class="fas fa-table text-blue-600 dark:text-blue-400 text-xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                            </div>
                        </div>
                        <p class="text-gray-500 dark:text-gray-300 font-semibold text-sm uppercase tracking-wide">Mesas
                            Procesadas</p>
                        <h1 class="text-5xl font-black text-blue-600 dark:text-blue-400 mt-2 mb-2">
                            {{ $mesasProcesadas }}
                        </h1>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Total de mesas ingresadas al sistema</p>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>Ingresadas</span>

                            </div>

                        </div>
                    </div>
                </div>

                {{-- Votos válidos --}}
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-300">
                    </div>
                    <div
                        class="relative p-6 rounded-2xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 transform transition-all duration-300 group-hover:scale-105">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            </div>
                        </div>
                        <p class="text-gray-500 dark:text-gray-300 font-semibold text-sm uppercase tracking-wide">Votos
                            Válidos</p>
                        <h1 class="text-5xl font-black text-green-600 dark:text-green-400 mt-2 mb-2">
                            {{ $totalesAlcalde->nacional +
                                $totalesAlcalde->liberal +
                                $totalesAlcalde->libre +
                                $totalesAlcalde->dc +
                                $totalesAlcalde->pinu }}

                        </h1>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Conteo total de votos válidos registrados
                        </p>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            @php
                                $totalVotos =
                                    $totalesGeneral->nacional +
                                    $totalesGeneral->liberal +
                                    $totalesGeneral->libre +
                                    $totalesGeneral->dc +
                                    $totalesGeneral->pinu +
                                    $totalesGeneral->nulos +
                                    $totalesGeneral->blancos;

                                $totalValidos =
                                    $totalesGeneral->nacional +
                                    $totalesGeneral->liberal +
                                    $totalesGeneral->libre +
                                    $totalesGeneral->dc +
                                    $totalesGeneral->pinu;

                                $porcentajeValidos =
                                    $totalVotos > 0 ? round(($totalValidos / $totalVotos) * 100, 1) : 0;
                            @endphp

                            <div class="flex items-center gap-2 text-xs text-green-600 font-semibold">
                                <i class="fas fa-trending-up"></i>
                                <span>Ingresadas</span>
                            </div>

                            <div class="mt-2 flex items-center justify-between text-xs text-gray-500">
                                <span>Porcentaje del total</span>
                                <span class="font-semibold text-green-600">{{ $porcentajeValidos }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Nulos + Blancos --}}
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-red-500 to-rose-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-300">
                    </div>
                    <div
                        class="relative p-6 rounded-2xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 transform transition-all duration-300 group-hover:scale-105">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center">
                                <i class="fas fa-times-circle text-red-600 dark:text-red-400 text-xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                            </div>
                        </div>
                        <p class="text-gray-500 dark:text-gray-300 font-semibold text-sm uppercase tracking-wide">Nulos
                            + Blancos</p>
                        <h1 class="text-5xl font-black text-red-600 dark:text-red-400 mt-2 mb-2">
                            {{ $totalesAlcalde->nulos + $totalesAlcalde->blancos }}

                        </h1>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Suma de votos no válidos</p>
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            @php
                                $totalVotos =
                                    $totalesGeneral->nacional +
                                    $totalesGeneral->liberal +
                                    $totalesGeneral->libre +
                                    $totalesGeneral->dc +
                                    $totalesGeneral->pinu +
                                    $totalesGeneral->nulos +
                                    $totalesGeneral->blancos;
                                $porcentajeNulosBlancos =
                                    $totalVotos > 0
                                        ? round(
                                            (($totalesGeneral->nulos + $totalesGeneral->blancos) / $totalVotos) * 100,
                                            1,
                                        )
                                        : 0;
                            @endphp
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>Porcentaje del total</span>
                                <span class="font-semibold text-red-600">{{ $porcentajeNulosBlancos }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MESAS ALCALDE --}}
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-300">
                    </div>
                    <div
                        class="relative p-6 rounded-2xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 transform transition-all duration-300 group-hover:scale-105">

                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                                <i class="fas fa-landmark text-green-600 dark:text-green-400 text-xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            </div>
                        </div>

                        <p class="text-gray-500 dark:text-gray-300 font-semibold text-sm uppercase tracking-wide">
                            Mesas Alcalde
                        </p>

                        <h1 class="text-5xl font-black text-green-600 dark:text-green-400 mt-2 mb-2">
                            {{ $mesasAlcalde }}
                        </h1>

                        <p class="text-sm text-gray-400 dark:text-gray-500">Total de mesas para alcalde escrutadas</p>
                    </div>
                </div>


                {{-- MESAS PRESIDENTE --}}
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-300">
                    </div>
                    <div
                        class="relative p-6 rounded-2xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 transform transition-all duration-300 group-hover:scale-105">

                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                                <i class="fas fa-flag text-blue-600 dark:text-blue-400 text-xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                            </div>
                        </div>

                        <p class="text-gray-500 dark:text-gray-300 font-semibold text-sm uppercase tracking-wide">
                            Mesas Presidente
                        </p>

                        <h1 class="text-5xl font-black text-blue-600 dark:text-blue-400 mt-2 mb-2">
                            {{ $mesasPresidente }}
                        </h1>

                        <p class="text-sm text-gray-400 dark:text-gray-500">Total de mesas para presidente escrutadas
                        </p>
                    </div>
                </div>
                {{-- COCIENTE --}}
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-300">
                    </div>

                    <div
                        class="relative p-6 rounded-2xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 transform transition-all duration-300 group-hover:scale-105">

                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                                <i class="fas fa-divide text-purple-600 dark:text-purple-400 text-xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="w-3 h-3 bg-purple-500 rounded-full animate-pulse"></div>
                            </div>
                        </div>

                        <p class="text-gray-500 dark:text-gray-300 font-semibold text-sm uppercase tracking-wide">
                            Cociente Alcalde</p>

                        <h1 class="text-5xl font-black text-purple-600 dark:text-purple-400 mt-2 mb-2">
                            {{ number_format($cociente, 2) }}
                        </h1>

                        <p class="text-sm text-gray-400 dark:text-gray-500">Total votos válidos alcalde ÷ 10</p>
                    </div>
                </div>


            </div>

            {{-- Sección título --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3
                        class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-gray-100 dark:to-gray-300 bg-clip-text text-transparent">
                        📊 Gráficas Comparativas
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Resultados detallados por nivel electoral
                    </p>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <i class="fas fa-sync-alt animate-spin"></i>
                    <span>Actualizando en tiempo real</span>
                </div>
            </div>

            {{-- ========================================================= --}}
            {{-- GRAFICAS SEPARADAS: BARRAS Y PASTEL --}}
            {{-- ========================================================= --}}
            {{-- Gráficas de Barras --}}
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h4
                            class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                            📈 Gráficas de Barras
                        </h4>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Comparación de totales por partido</p>
                    </div>
                    <span
                        class="px-3 py-1 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-full text-sm font-semibold">
                        Totales
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Alcalde - Barra --}}
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-600 rounded-3xl blur opacity-20 group-hover:opacity-30 transition duration-300">
                        </div>
                        <div
                            class="relative p-6 rounded-3xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 transform transition-all duration-300 group-hover:scale-[1.02]">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h5
                                        class="text-lg font-bold text-blue-700 dark:text-blue-400 flex items-center gap-3">
                                        <i class="fas fa-landmark"></i>
                                        Alcalde — Totales
                                    </h5>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Votos totales por partido</p>
                                </div>
                                <span
                                    class="px-2 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full text-xs font-semibold">Barras</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                                <canvas id="graficaAlcaldeTotales" height="220"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- Presidente - Barra --}}
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl blur opacity-20 group-hover:opacity-30 transition duration-300">
                        </div>
                        <div
                            class="relative p-6 rounded-3xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 transform transition-all duration-300 group-hover:scale-[1.02]">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h5
                                        class="text-lg font-bold text-green-700 dark:text-green-400 flex items-center gap-3">
                                        <i class="fas fa-flag"></i>
                                        Presidente — Totales
                                    </h5>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Votos totales por partido</p>
                                </div>
                                <span
                                    class="px-2 py-1 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full text-xs font-semibold">Barras</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                                <canvas id="graficaPresidenteTotales" height="220"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Gráficas Tipo Pastel / Doughnut --}}
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h4
                            class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                            🥧 Gráficas Tipo Pastel
                        </h4>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Porcentajes de distribución por
                            partido</p>
                    </div>
                    <span
                        class="px-3 py-1 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-full text-sm font-semibold">
                        Porcentajes
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Alcalde - Pastel --}}
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-400 to-cyan-500 rounded-3xl blur opacity-15 group-hover:opacity-25 transition duration-300">
                        </div>
                        <div
                            class="relative p-6 rounded-3xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h5
                                        class="text-lg font-bold text-blue-700 dark:text-blue-400 flex items-center gap-3">
                                        <i class="fas fa-chart-pie"></i>
                                        Alcalde — Porcentajes
                                    </h5>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Distribución porcentual</p>
                                </div>
                                <span
                                    class="px-2 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full text-xs font-semibold">Pastel</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl flex items-center justify-center">
                                <canvas id="graficaAlcaldePorcentaje" height="220"
                                    style="max-width:320px;"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- Presidente - Pastel --}}
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-500 rounded-3xl blur opacity-15 group-hover:opacity-25 transition duration-300">
                        </div>
                        <div
                            class="relative p-6 rounded-3xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h5
                                        class="text-lg font-bold text-green-700 dark:text-green-400 flex items-center gap-3">
                                        <i class="fas fa-chart-pie"></i>
                                        Presidente — Porcentajes
                                    </h5>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Distribución porcentual</p>
                                </div>
                                <span
                                    class="px-2 py-1 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full text-xs font-semibold">Pastel</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-xl flex items-center justify-center">
                                <canvas id="graficaPresidentePorcentaje" height="220"
                                    style="max-width:320px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- ========================================================= --}}
            {{-- ULTIMAS ACTAS REGISTRADAS --}}
            {{-- ========================================================= --}}
            <div class="group relative mb-12">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-3xl blur opacity-20 group-hover:opacity-30 transition duration-300">
                </div>
                <div
                    class="relative p-8 rounded-3xl shadow-2xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-file-alt text-purple-600 dark:text-purple-400"></i>
                                </div>
                                Últimas Actas Registradas
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Registros más recientes del
                                sistema</p>
                        </div>
                        <span
                            class="px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-full text-sm font-semibold">
                            {{ $actas->count() }} registros
                        </span>
                    </div>

                    <div
                        class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b-2 border-gray-300 dark:border-gray-600">
                                        <th
                                            class="py-4 px-4 text-left font-bold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wider">
                                            Mesa</th>
                                        <th
                                            class="py-4 px-4 text-left font-bold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wider">
                                            Nivel</th>
                                        <th
                                            class="py-4 px-4 text-left font-bold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wider">
                                            Usuario</th>
                                        <th
                                            class="py-4 px-4 text-left font-bold text-gray-700 dark:text-gray-300 text-sm uppercase tracking-wider">
                                            Fecha</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($actas as $a)
                                        <tr
                                            class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                            <td class="py-4 px-4 font-medium text-gray-900 dark:text-gray-100">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                                                        {{ $a->mesa->codigo }}
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                                    {{ $a->nivel == 'presidencial' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200' : '' }}
                                                    {{ $a->nivel == 'alcalde' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200' : '' }}
                                                    {{ $a->nivel == 'todos' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' : '' }}">
                                                    {{ ucfirst($a->nivel) }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-4 text-gray-700 dark:text-gray-300">
                                                <div class="flex items-center gap-2">
                                                    <div
                                                        class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center text-white text-xs">
                                                        {{ strtoupper(substr($a->user->name, 0, 1)) }}
                                                    </div>
                                                    {{ $a->user->name }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-gray-600 dark:text-gray-400">
                                                <div class="text-sm">{{ $a->created_at->format('d/m/Y') }}</div>
                                                <div class="text-xs text-gray-500">{{ $a->created_at->format('H:i') }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            {{-- ========================================================= --}}
            {{-- ÚLTIMA ACTUALIZACIÓN --}}
            {{-- ========================================================= --}}
            <div class="text-center">
                <div
                    class="inline-flex items-center gap-3 px-6 py-3 bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <i class="fas fa-clock text-blue-500"></i>
                    <span class="text-gray-600 dark:text-gray-400 text-sm">
                        Última actualización:
                        <span
                            class="font-semibold text-gray-800 dark:text-gray-200">{{ now()->format('d/m/Y H:i:s') }}</span>
                    </span>
                </div>
            </div>

        </div>
    </div>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- ========================= --}}
    {{-- SCRIPTS CHART JS --}}
    {{-- ========================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const colores = ['#3B82F6', '#EF4444', '#DC2626', '#10B981', '#06B6D4'];

        // Configuración común para gráficas de barras
        const barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(255, 255, 255, 0.2)',
                    borderWidth: 1,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        color: '#6B7280'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6B7280'
                    }
                }
            }
        };

        // Configuración común para gráficas de doughnut
        const doughnutChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#6B7280',
                        font: {
                            size: 11
                        }
                    }
                }
            },
            cutout: '65%'
        };

        // -----------------------------
        // ALCALDE – Totales
        // -----------------------------
        new Chart(document.getElementById('graficaAlcaldeTotales'), {
            type: 'bar',
            data: {
                labels: ['Nacional', 'Liberal', 'Libre', 'DC', 'PINU'],
                datasets: [{
                    label: 'Votos Totales',
                    backgroundColor: colores,
                    borderColor: colores.map(color => color.replace('0.8', '1')),
                    borderWidth: 2,
                    borderRadius: 8,
                    data: [
                        {{ $totalesAlcalde->nacional }},
                        {{ $totalesAlcalde->liberal }},
                        {{ $totalesAlcalde->libre }},
                        {{ $totalesAlcalde->dc }},
                        {{ $totalesAlcalde->pinu }}
                    ]
                }]
            },
            options: barChartOptions
        });

        // -----------------------------
        // ALCALDE – Porcentaje
        // -----------------------------
        new Chart(document.getElementById('graficaAlcaldePorcentaje'), {
            type: 'doughnut',
            data: {
                labels: ['Nacional', 'Liberal', 'Libre', 'DC', 'PINU'],
                datasets: [{
                    label: '%',
                    backgroundColor: colores,
                    borderColor: '#fff',
                    borderWidth: 2,
                    data: [
                        {{ $porcentajeAlcalde['nacional'] }},
                        {{ $porcentajeAlcalde['liberal'] }},
                        {{ $porcentajeAlcalde['libre'] }},
                        {{ $porcentajeAlcalde['dc'] }},
                        {{ $porcentajeAlcalde['pinu'] }}
                    ]
                }]
            },
            options: doughnutChartOptions
        });

        // -----------------------------
        // PRESIDENTE – Totales
        // -----------------------------
        new Chart(document.getElementById('graficaPresidenteTotales'), {
            type: 'bar',
            data: {
                labels: ['Nacional', 'Liberal', 'Libre', 'DC', 'PINU'],
                datasets: [{
                    label: 'Votos Totales',
                    backgroundColor: colores,
                    borderColor: colores.map(color => color.replace('0.8', '1')),
                    borderWidth: 2,
                    borderRadius: 8,
                    data: [
                        {{ $totalesPresidente->nacional }},
                        {{ $totalesPresidente->liberal }},
                        {{ $totalesPresidente->libre }},
                        {{ $totalesPresidente->dc }},
                        {{ $totalesPresidente->pinu }}
                    ]
                }]
            },
            options: barChartOptions
        });

        // -----------------------------
        // PRESIDENTE – Porcentaje
        // -----------------------------
        new Chart(document.getElementById('graficaPresidentePorcentaje'), {
            type: 'doughnut',
            data: {
                labels: ['Nacional', 'Liberal', 'Libre', 'DC', 'PINU'],
                datasets: [{
                    label: '%',
                    backgroundColor: colores,
                    borderColor: '#fff',
                    borderWidth: 2,
                    data: [
                        {{ $porcentajePresidente['nacional'] }},
                        {{ $porcentajePresidente['liberal'] }},
                        {{ $porcentajePresidente['libre'] }},
                        {{ $porcentajePresidente['dc'] }},
                        {{ $porcentajePresidente['pinu'] }}
                    ]
                }]
            },
            options: doughnutChartOptions
        });
    </script>

</x-app-layout>
