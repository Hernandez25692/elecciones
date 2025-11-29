<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Dashboard Electoral – Resultados Actuales
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- ========================================================= --}}
            {{-- RESUMEN GENERAL --}}
            {{-- ========================================================= --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Mesas procesadas --}}
                <div class="p-6 bg-white dark:bg-gray-900 rounded shadow text-center">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Mesas Procesadas</h3>
                    <p class="text-4xl font-bold text-blue-600 dark:text-blue-400 mt-2">
                        {{ $mesasProcesadas }}
                    </p>
                </div>

                {{-- Votos válidos --}}
                <div class="p-6 bg-white dark:bg-gray-900 rounded shadow text-center">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Votos Válidos</h3>
                    <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-2">
                        {{ $totalesGeneral->nacional +
                            $totalesGeneral->liberal +
                            $totalesGeneral->libre +
                            $totalesGeneral->dc +
                            $totalesGeneral->pinu }}
                    </p>
                </div>

                {{-- Nulos y blancos --}}
                <div class="p-6 bg-white dark:bg-gray-900 rounded shadow text-center">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Nulos + Blancos</h3>
                    <p class="text-4xl font-bold text-red-600 dark:text-red-400 mt-2">
                        {{ $totalesGeneral->nulos + $totalesGeneral->blancos }}
                    </p>
                </div>

            </div>



            



            {{-- ========================================================= --}}
            {{-- GRÁFICAS SEPARADAS: ALCALDE + PRESIDENTE --}}
            {{-- ========================================================= --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

                {{-- Alcalde --}}
                <div class="p-6 bg-white dark:bg-gray-900 rounded shadow">
                    <h3 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-4">
                        🏛️ Resultados Nivel Alcalde
                    </h3>

                    <canvas id="graficaAlcalde" height="110"></canvas>
                </div>

                {{-- Presidente --}}
                <div class="p-6 bg-white dark:bg-gray-900 rounded shadow">
                    <h3 class="text-lg font-semibold text-green-600 dark:text-green-400 mb-4">
                        👔 Resultados Nivel Presidente
                    </h3>

                    <canvas id="graficaPresidente" height="110"></canvas>
                </div>

            </div>

        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- SCRIPTS: CHART JS --}}
    {{-- ========================================================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // ==== Gráfica General ====
        new Chart(document.getElementById('graficaGeneral'), {
            type: 'bar',
            data: {
                labels: ['Nacional', 'Liberal', 'Libre', 'DC', 'PINU'],
                datasets: [{
                    label: 'Votos Totales',
                    backgroundColor: ['#0047AB', '#E00000', '#8B0000', '#0B5D1E', '#0072BB'],
                    data: [
                        {{ $totalesGeneral->nacional }},
                        {{ $totalesGeneral->liberal }},
                        {{ $totalesGeneral->libre }},
                        {{ $totalesGeneral->dc }},
                        {{ $totalesGeneral->pinu }}
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });


        // ==== Gráfica Alcalde ====
        new Chart(document.getElementById('graficaAlcalde'), {
            type: 'bar',
            data: {
                labels: ['Nacional', 'Liberal', 'Libre', 'DC', 'PINU'],
                datasets: [{
                    label: 'Votos Alcalde',
                    backgroundColor: ['#0047AB', '#E00000', '#8B0000', '#0B5D1E', '#0072BB'],
                    data: [
                        {{ $totalesAlcalde->nacional }},
                        {{ $totalesAlcalde->liberal }},
                        {{ $totalesAlcalde->libre }},
                        {{ $totalesAlcalde->dc }},
                        {{ $totalesAlcalde->pinu }}
                    ]
                }]
            }
        });


        // ==== Gráfica Presidente ====
        new Chart(document.getElementById('graficaPresidente'), {
            type: 'bar',
            data: {
                labels: ['Nacional', 'Liberal', 'Libre', 'DC', 'PINU'],
                datasets: [{
                    label: 'Votos Presidente',
                    backgroundColor: ['#0047AB', '#E00000', '#8B0000', '#0B5D1E', '#0072BB'],
                    data: [
                        {{ $totalesPresidente->nacional }},
                        {{ $totalesPresidente->liberal }},
                        {{ $totalesPresidente->libre }},
                        {{ $totalesPresidente->dc }},
                        {{ $totalesPresidente->pinu }}
                    ]
                }]
            }
        });
    </script>

</x-app-layout>
