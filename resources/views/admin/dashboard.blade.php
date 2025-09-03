@extends('admin.layouts.app')

@section('content')
<main class="flex-1 p-6 bg-primary">
    <h2 class="text-3xl font-semibold mb-2 text-center md:text-left">
        <span class="text-[#f36100]">Bienvenido</span> <span class="text-white">al Dashboard</span>
    </h2>

    <!-- Línea decorativa -->
    <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-600 to-transparent my-4"></div>

    <!-- Cards -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-6">

        <!-- Diagrama de pastel -->
        <div class="col-span-1 sm:col-span-3 lg:col-span-2 bg-[#1f1f1f] p-6 rounded-2xl shadow-lg border border-[#2a2a2a]">
            <h2 class="text-xl font-bold text-center mb-4 text-white">Usuarios por Estado</h2>

            <div class="mb-4 text-center">
                <label for="periodSelect" class="text-white mr-2">Periodo:</label>
                <select id="periodSelect" class="text-white rounded px-2 py-1" style="background-color: #252525;">
                    <option value="all">Todos</option>
                    <option value="today">Hoy</option>
                    <option value="this_month">Este mes</option>
                    <option value="last_month">Mes pasado</option>
                    <option value="two_months_ago">Hace dos meses</option>
                </select>
            </div>

            <canvas id="usuariosChart" class="w-full h-[300px]"></canvas>
        </div>

        <!-- Diagrama de línea ancho -->
        <div class="col-span-1 sm:col-span-3 lg:col-span-4 bg-[#1f1f1f] p-6 rounded-2xl shadow-lg border border-[#2a2a2a]">
            <h2 class="text-xl font-bold text-center mb-4 text-white">Nuevos Usuarios por Mes</h2>
            <canvas id="usersLineChart" class="w-full h-[300px]"></canvas>
        </div>

        <!-- Gráfico de Ganancias por Mes -->
        <div class="col-span-1 lg:col-span-6 bg-[#1f1f1f] p-6 rounded-2xl shadow-lg border border-[#2a2a2a]">
            <h3 class="text-xl font-bold text-center mb-4 text-white">Ganancias Mensuales</h3>
            <canvas id="gananciasChart" class="w-full h-[300px]"></canvas>
        </div>


        

        <!-- Estadística adicional - Heatmap -->
         
        <div class="col-span-1 lg:col-span-6 bg-[#1f1f1f] p-6 rounded-2xl shadow-lg border border-[#2a2a2a]">
            <h3 class="text-xl font-bold text-center mb-4 text-white">Asistencias por Día</h3>
            <div id="asistencia-heatmap" class="overflow-x-auto"></div>
        </div>

        

    </div>

    <!-- Scripts -->
    <script>
        // PIE CHART
        const ctx = document.getElementById('usuariosChart').getContext('2d');
        const gradienteActivo = ctx.createLinearGradient(0, 0, 0, 400);
        gradienteActivo.addColorStop(0, '#00FFA3');
        gradienteActivo.addColorStop(1, '#00664F');

        const gradienteInactivo = ctx.createLinearGradient(0, 0, 0, 400);
        gradienteInactivo.addColorStop(0, '#FF4C60');
        gradienteInactivo.addColorStop(1, '#800020');

        let usuariosChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Activos', 'Inactivos'],
                datasets: [{
                    data: [{{ $activos }}, {{ $inactivos }}],
                    backgroundColor: [gradienteActivo, gradienteInactivo],
                    borderColor: ['#00FFA3', '#FF4C60'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#fff' }
                    }
                }
            }
        });

        document.getElementById('periodSelect').addEventListener('change', function() {
            const period = this.value;
            fetch(`{{ route('user.stats') }}?period=${period}`)
                .then(response => response.json())
                .then(data => {
                    usuariosChart.data.datasets[0].data = [data.activos, data.inactivos];
                    usuariosChart.update();
                })
                .catch(error => {
                    console.error('Error al cargar datos:', error);
                });
        });

        // LINE CHART
        const lineCtx = document.getElementById('usersLineChart').getContext('2d');
        fetch('/dashboard/users-by-month')
            .then(res => res.json())
            .then(data => {
                const labels = data.map(entry => entry.mes);
                const totals = data.map(entry => entry.total);

                new Chart(lineCtx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Nuevos Usuarios',
                            data: totals,
                            borderColor: '#34D399',
                            backgroundColor: 'rgba(52, 211, 153, 0.2)',
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { color: '#fff' }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#fff',
                                    stepSize: 1,
                                    precision: 0
                                },
                                grid: {
                                    color: 'rgba(255,255,255,0.1)'
                                }
                            },
                            x: {
                                ticks: { color: '#fff' },
                                grid: {
                                    color: 'rgba(255,255,255,0.1)'
                                }
                            }
                        }
                    }
                });
            })
            .catch(err => console.error('Error cargando datos de usuarios por mes:', err));       
    </script>
    
    
</main>
@endsection
