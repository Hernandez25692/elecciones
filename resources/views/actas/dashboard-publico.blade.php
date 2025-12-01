<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Electoral Público — En Vivo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, sans-serif;
            overflow-x: hidden;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: auto;
            position: relative;
        }

        .glass-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 0 80px rgba(59, 130, 246, 0.1);
            padding: 28px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.4), transparent);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.4),
                0 0 100px rgba(59, 130, 246, 0.15);
        }

        .section-title {
            position: relative;
            padding-bottom: 12px;
            margin-bottom: 24px;
            font-size: 22px;
            font-weight: 700;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, currentColor, transparent);
            border-radius: 2px;
        }

        .stat-card {
            position: relative;
            padding: 24px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.95) 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #60a5fa, #3b82f6);
            border-radius: 20px 20px 0 0;
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            animation: pulse 2s infinite;
            display: inline-block;
            margin-right: 8px;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.2);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #60a5fa 0%, #34d399 50%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .live-badge {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            animation: pulse 2s infinite;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .party-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .chart-container {
            position: relative;
            height: 320px;
            padding: 16px;
        }

        .progress-ring {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .progress-ring circle {
            fill: none;
            stroke-width: 2;
            stroke: rgba(59, 130, 246, 0.2);
            stroke-dasharray: 628;
            stroke-dashoffset: 628;
            animation: progress 3s ease-in-out infinite;
            transform-origin: center;
            transform: rotate(-90deg);
        }

        @keyframes progress {
            0% {
                stroke-dashoffset: 628;
            }

            50% {
                stroke-dashoffset: 0;
            }

            100% {
                stroke-dashoffset: 628;
            }
        }

        .floating-element {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            filter: blur(40px);
            animation: float 6s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .update-indicator {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 12px;
            font-size: 0.875rem;
            color: #60a5fa;
        }
    </style>
</head>
@php
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403, 'Acceso denegado — Solo para administradores.');
    }
@endphp

<body class="text-gray-100">
    <!-- Floating Background Elements -->
    <div class="floating-element" style="top: 10%; left: 5%; animation-delay: 0s;"></div>
    <div class="floating-element"
        style="top: 60%; right: 8%; animation-delay: 2s; background: radial-gradient(circle, rgba(34, 197, 94, 0.1) 0%, transparent 70%);">
    </div>
    <div class="floating-element"
        style="bottom: 20%; left: 15%; animation-delay: 4s; background: radial-gradient(circle, rgba(168, 85, 247, 0.1) 0%, transparent 70%);">
    </div>

    <div class="dashboard-container py-8 px-4 sm:px-6">

        <!-- HEADER -->
        <div class="text-center mb-12 relative">
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="live-badge">
                    <i class="fas fa-circle text-xs"></i>
                    EN VIVO
                </span>
                <span class="update-indicator">
                    <i class="fas fa-sync-alt animate-spin"></i>
                    Actualizando en tiempo real
                </span>
            </div>

            <h1 class="text-5xl font-black mb-4 gradient-text">
                <i class="fas fa-chart-network mr-4"></i>Dashboard Electoral
            </h1>

            <p class="text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Resultados en tiempo real del proceso electoral
                <span class="block text-sm mt-2 text-cyan-400" id="lastUpdate"></span>
            </p>
        </div>

        <!-- TARJETAS PRINCIPALES -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            {{-- Mesas procesadas --}}
            <div class="stat-card group">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-table text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-blue-300 font-semibold text-lg">Mesas Procesadas</h3>
                            <p class="text-gray-400 text-sm">Total contabilizado</p>
                        </div>
                    </div>
                    <div class="pulse-dot"></div>
                </div>
                <div id="mesasProcesadas" class="stat-number mb-2">
                    {{ $mesasProcesadas }}
                </div>
                <div class="text-sm text-gray-400 flex items-center gap-2">
                    <i class="fas fa-trend-up text-green-400"></i>

                </div>
                <svg class="progress-ring" viewBox="0 0 200 200">
                    <circle cx="100" cy="100" r="95"></circle>
                </svg>
            </div>

            {{-- Votos válidos --}}
            <div class="stat-card group">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-green-300 font-semibold text-lg">Votos Válidos</h3>
                            <p class="text-gray-400 text-sm">Total registrado</p>
                        </div>
                    </div>
                </div>

                @php
                    $validos = intval($totalesGeneral->nacional ?? 0)
                        + intval($totalesGeneral->liberal ?? 0)
                        + intval($totalesGeneral->libre ?? 0)
                        + intval($totalesGeneral->dc ?? 0)
                        + intval($totalesGeneral->pinu ?? 0);

                    $nulosBlancos = intval($totalesGeneral->nulos ?? 0) + intval($totalesGeneral->blancos ?? 0);
                    $totalGeneral = $validos + $nulosBlancos;
                    $porcentajeValidos = $totalGeneral > 0 ? round(($validos / $totalGeneral) * 100, 1) : 0;
                @endphp

                <div id="votosValidos" class="stat-number mb-2">
                    {{ $porcentajeValidos }}%
                </div>
                <div class="text-sm text-gray-400 flex items-center gap-2">
                    <i class="fas fa-users text-blue-400"></i>
                    <span>Participación ciudadana</span>
                </div>
            </div>

            {{-- Nulos + Blancos --}}
            <div class="stat-card group">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-times-circle text-red-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-red-300 font-semibold text-lg">Nulos + Blancos</h3>
                            <p class="text-gray-400 text-sm">Votos no válidos</p>
                        </div>
                    </div>
                </div>

                @php
                    $porcentajeNulos = $totalGeneral > 0 ? round(($nulosBlancos / $totalGeneral) * 100, 1) : 0;
                @endphp

                <div id="nulosBlancos" class="stat-number mb-2">
                    {{ $porcentajeNulos }}%
                </div>
                <div class="text-sm text-gray-400 flex items-center gap-2">
                    <i class="fas fa-chart-pie text-purple-400"></i>
                    <span>{{ $porcentajeNulos }}% del total</span>
                </div>
            </div>
        </div>

        <!-- GRÁFICAS PRINCIPALES -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <div class="glass-card">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="section-title text-blue-300">
                        <i class="fas fa-landmark mr-3"></i> Nivel Alcalde
                    </h3>
                    <div class="flex gap-2">
                        <span class="party-badge text-blue-300">
                            <i class="fas fa-chart-bar mr-1"></i>Resultados
                        </span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="graficaAlcalde"></canvas>
                </div>
            </div>

            <div class="glass-card">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="section-title text-green-300">
                        <i class="fas fa-flag mr-3"></i> Nivel Presidente
                    </h3>
                    <div class="flex gap-2">
                        <span class="party-badge text-green-300">
                            <i class="fas fa-chart-line mr-1"></i>Tendencia
                        </span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="graficaPresidente"></canvas>
                </div>
            </div>
        </div>

        <!-- RESUMEN GENERAL ORDENADO -->
        <div class="glass-card mb-10">
            <div class="flex items-center justify-between mb-6">
                <h3 class="section-title text-cyan-300">
                    <i class="fas fa-trophy mr-3"></i> Resumen General Ordenado
                </h3>
                <span class="party-badge text-cyan-300">
                    <i class="fas fa-list-ol mr-1"></i>Ranking
                </span>
            </div>

            <div id="contenedorResumen" class="grid grid-cols-2 md:grid-cols-5 gap-4"></div>
        </div>

        <!-- FOOTER INFORMATIVO -->
        <div class="text-center text-gray-500 text-sm">
            <p>Douglas Jesus- Jose Hernandez Sistema de Monitoreo Electoral • Última actualización: <span id="fullLastUpdate"></span></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>

    <script>
        // Registrar plugin para mostrar etiquetas siempre
        if (typeof Chart !== 'undefined' && typeof ChartDataLabels !== 'undefined') {
            Chart.register(ChartDataLabels);
        }

        // Inicialización gráfica
        let graficaAlcalde, graficaPresidente;

        async function cargarDatos() {
            const res = await fetch("/api/resultados");
            const data = await res.json();

            document.getElementById("mesasProcesadas").textContent = data.mesasProcesadas;

            let g = data.general;

            let validos =
                (parseInt(g.nacional ?? 0)) +
                (parseInt(g.liberal ?? 0)) +
                (parseInt(g.libre ?? 0)) +
                (parseInt(g.dc ?? 0)) +
                (parseInt(g.pinu ?? 0));

            let nulosBlancos = (parseInt(g.nulos ?? 0)) + (parseInt(g.blancos ?? 0));
            let totalGeneral = validos + nulosBlancos;

            // Actualizar tarjetas como porcentajes
            const porcentajeValidos = totalGeneral > 0 ? parseFloat(((validos / totalGeneral) * 100).toFixed(1)) : 0;
            const porcentajeNulos = totalGeneral > 0 ? parseFloat(((nulosBlancos / totalGeneral) * 100).toFixed(1)) : 0;

            document.getElementById("votosValidos").textContent = `${porcentajeValidos}%`;
            document.getElementById("nulosBlancos").textContent = `${porcentajeNulos}%`;

            // actualizar texto de "del total" si lo deseas dinámico: (opcional)
            // const spanDelTotal = document.querySelector('#nulosBlancos + .text-sm span');
            // if (spanDelTotal) spanDelTotal.textContent = `${porcentajeNulos}% del total`;

            actualizarGraficas(data);
            actualizarResumen(data.general);

            const now = new Date();
            document.getElementById("lastUpdate").textContent = now.toLocaleTimeString();
            document.getElementById("fullLastUpdate").textContent = now.toLocaleString();
        }

        function ordenar(obj) {
            return Object.entries(obj)
                .filter(([k]) => !['nulos', 'blancos'].includes(k))
                .sort((a, b) => b[1] - a[1]);
        }

        function actualizarResumen(data) {
            const cont = document.getElementById("contenedorResumen");
            cont.innerHTML = "";

            let partidos = {
                nacional: ["Nacional", "from-blue-500 to-blue-600", "#3b82f6"],
                liberal: ["Liberal", "from-red-500 to-red-600", "#ef4444"],
                libre: ["Libre", "from-rose-500 to-rose-600", "#f43f5e"],
                dc: ["DC", "from-emerald-500 to-emerald-600", "#10b981"],
                pinu: ["PINU", "from-cyan-500 to-cyan-600", "#06b6d4"]
            };

            // valorTotal (suma total de los valores en 'data')
            let valorTotal = Object.values(data)
                .reduce((acc, x) => acc + (parseInt(x) || 0), 0);

            ordenar(data).forEach(([key, valor], index) => {
                const party = partidos[key];
                const porcentaje = valorTotal > 0 ? ((valor / valorTotal) * 100).toFixed(1) : 0;
                cont.innerHTML += `
                    <div class="text-center p-6 rounded-2xl bg-gradient-to-br ${party[1]} border border-white/10 shadow-lg transform transition-transform hover:scale-105">
                        <div class="text-3xl font-black text-white mb-2 drop-shadow-lg">${porcentaje}%</div>
                        <div class="text-white/90 font-semibold text-sm mb-1">${party[0]}</div>
                        <div class="text-white/70 text-xs">Posición #${index + 1}</div>
                    </div>
                `;
            });
        }

        function actualizarGraficas(data) {
            // ORDENAR
            let ordA = ordenar(data.alcalde);
            let ordP = ordenar(data.presidente);

            let labelsA = ordA.map(i => i[0].toUpperCase());
            // reemplazo: pasar a porcentajes por grupo
            let totalA = ordA.reduce((acc, v) => acc + (parseInt(v[1]) || 0), 0);
            let valoresA = ordA.map(i => totalA > 0 ? parseFloat(((i[1] / totalA) * 100).toFixed(1)) : 0);

            let labelsP = ordP.map(i => i[0].toUpperCase());
            let totalP = ordP.reduce((acc, v) => acc + (parseInt(v[1]) || 0), 0);
            let valoresP = ordP.map(i => totalP > 0 ? parseFloat(((i[1] / totalP) * 100).toFixed(1)) : 0);

            // COLORES
            let colores = {
                NACIONAL: 'rgba(59, 130, 246, 0.8)',
                LIBERAL: 'rgba(239, 68, 68, 0.8)',
                LIBRE: 'rgba(244, 63, 94, 0.8)',
                DC: 'rgba(16, 185, 129, 0.8)',
                PINU: 'rgba(6, 182, 212, 0.8)'
            };

            // Configuración común para gráficas
            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#e2e8f0',
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.95)',
                        titleColor: '#e2e8f0',
                        bodyColor: '#e2e8f0',
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 1,
                        cornerRadius: 12,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                let v = context.parsed.y;
                                return `${v}%`;
                            }
                        }
                    },
                    // plugin datalabels: etiquetas más grandes y resaltadas
                    datalabels: {
                        display: true,
                        color: '#ffffff',
                        backgroundColor: 'rgba(0, 0, 0, 0.65)', // fondo para resaltar
                        borderColor: 'rgba(255,255,255,0.12)',
                        borderWidth: 1,
                        borderRadius: 6,
                        padding: 6,
                        clamp: true,
                        font: {
                            weight: '900',
                            size: 16 // tamaño aumentado
                        },
                        formatter: function(value) {
                            // value ya es porcentaje en nuestros datasets
                            return value + '%';
                        },
                        anchor: 'end', // posicionar sobre el extremo superior de la barra
                        align: 'end',
                        offset: -10
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                weight: '600'
                            },
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                weight: '600'
                            }
                        }
                    }
                }
            };

            // Alcalde
            if (graficaAlcalde) graficaAlcalde.destroy();

            graficaAlcalde = new Chart(document.getElementById("graficaAlcalde"), {
                type: 'bar',
                data: {
                    labels: labelsA,
                    datasets: [{
                        label: "Votos Alcalde (%)",
                        data: valoresA,
                        backgroundColor: labelsA.map(l => colores[l]),
                        borderColor: labelsA.map(l => colores[l] ? colores[l].replace('0.8', '1') : 'rgba(255,255,255,1)'),
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: chartOptions,
                plugins: [ChartDataLabels] // asegurar que el plugin se aplique
            });

            // Presidente
            if (graficaPresidente) graficaPresidente.destroy();

            graficaPresidente = new Chart(document.getElementById("graficaPresidente"), {
                type: 'bar',
                data: {
                    labels: labelsP,
                    datasets: [{
                        label: "Votos Presidente (%)",
                        data: valoresP,
                        backgroundColor: labelsP.map(l => colores[l]),
                        borderColor: labelsP.map(l => colores[l] ? colores[l].replace('0.8', '1') : 'rgba(255,255,255,1)'),
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: chartOptions,
                plugins: [ChartDataLabels]
            });
        }

        // Inicializar
        cargarDatos();
        setInterval(cargarDatos, 3000); // Actualización en tiempo real
    </script>

</body>

</html>
