<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Plataforma de Digitación — Partido Nacional de Honduras
        </h2>
    </x-slot>

    <style>
        .pn-banner {
            background: linear-gradient(135deg, #002F6C 0%, #003C8F 50%, #001F4D 100%);
            border-radius: 16px;
            padding: 35px;
            color: white;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.4);
        }

        .pn-title {
            font-size: 1.9rem;
            font-weight: 800;
            text-shadow: 0 0 8px rgba(150, 200, 255, 0.6);
        }

        .pn-sub {
            font-size: 1.1rem;
            color: #dbeafe;
        }

        .pn-section {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        }

        .text-pn {
            color: #002F6C;
        }
    </style>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- BANNER PRINCIPAL --}}
            <div class="pn-banner mb-10 flex items-center gap-6">
                <img src="{{ asset('storage/logos/NACIONAL.jpg') }}"
                    class="w-24 h-24 rounded shadow-lg ring-2 ring-white">

                <div>
                    <h1 class="pn-title">Sistema de Digitación Electoral 2025</h1>
                    <p class="pn-sub">Partido Nacional de Honduras — Plataforma Oficial</p>
                </div>
            </div>

            {{-- CONTENIDO EXPLICATIVO DEL SISTEMA --}}
            <div class="pn-section">

                <h2 class="text-2xl font-bold text-pn mb-4">
                    ¿En qué consiste este sistema?
                </h2>

                <p class="text-gray-700 leading-relaxed mb-6">
                    Esta plataforma fue desarrollada por <strong>José Hernández</strong> con el objetivo de
                    ofrecer una herramienta moderna, ágil y precisa para el registro, digitación y
                    análisis de resultados electorales del <strong>Partido Nacional de Honduras</strong>
                    durante las Elecciones Generales 2025.
                </p>

                <ul class="list-disc pl-6 text-gray-700 leading-relaxed mb-6 space-y-2">
                    <li>
                        Registro seguro de <strong>actas electorales</strong> para Alcalde y Presidente.
                    </li>
                    <li>
                        Carga de votos por partido con validaciones y control de duplicados.
                    </li>
                    <li>
                        Panel administrativo para supervisión y auditoría.
                    </li>
                    <li>
                        Dashboard interno con estadísticas avanzadas, gráficos y totales globales.
                    </li>
                    <li>
                        Dashboard público para presentación oficial de resultados procesados.
                    </li>
                    <li>
                        Gestión de usuarios con roles: <strong>Administrador y Digitador</strong>.
                    </li>
                    <li>
                        Sistema optimizado para velocidad, claridad y transparencia.
                    </li>
                </ul>

                <div class="bg-blue-50 border-l-4 border-blue-700 p-4 rounded">
                    <p class="text-blue-800 font-semibold">
                        “Este sistema busca fortalecer la confianza, la transparencia y la eficiencia del
                        proceso electoral interno, garantizando datos confiables y accesibles en tiempo real.”
                    </p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
