<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Título do Usuário -->
                <div class="p-6 text-gray-900 bg-gray-100 rounded-md shadow mb-4">
                    <h2 class="font-bold text-xl">Contas de {{ $user->name }}</h2>
                </div>

                <!-- Gráfico: Resumo das Contas a Pagar -->
                <div class="p-6 text-gray-900 bg-gray-100 rounded-md shadow mb-4">
                    <canvas id="toPayChart" style="height: 400px; width: 100%;"></canvas>
                </div>

                <!-- Gráfico: Resumo das Contas a Receber -->
                <div class="p-6 text-gray-900 bg-gray-100 rounded-md shadow">
                    <canvas id="toReceiveChart" style="height: 400px; width: 100%;"></canvas>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Código dos gráficos permanece o mesmo...
        const ctxToPay = document.getElementById('toPayChart').getContext('2d');
        const toPayChart = new Chart(ctxToPay, {
            type: 'bar',
            data: {
                labels: ['Pagas', 'Pendentes', 'Vencidas'],
                datasets: [{
                    label: 'Contas a Pagar',
                    data: [
                        {{ $paidCountToPay }},
                        {{ $pendingCountToPay }},
                        {{ $overdueCountToPay }}
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Resumo das Contas a Pagar',
                        font: {
                            size: 16
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantidade'
                        }
                    }
                }
            }
        });

        const ctxToReceive = document.getElementById('toReceiveChart').getContext('2d');
        const toReceiveChart = new Chart(ctxToReceive, {
            type: 'bar',
            data: {
                labels: ['Pagas', 'Pendentes', 'Vencidas'],
                datasets: [{
                    label: 'Contas a Receber',
                    data: [
                        {{ $paidCountToReceive }},
                        {{ $pendingCountToReceive }},
                        {{ $overdueCountToReceive }}
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Resumo das Contas a Receber',
                        font: {
                            size: 16
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantidade'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
