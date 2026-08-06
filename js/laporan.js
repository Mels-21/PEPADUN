// laporan.js
document.addEventListener('DOMContentLoaded', function() {
    // Kepatuhan Donut Chart
    const kepatuhanCtx = document.getElementById('kepatuhanChart');
    if (kepatuhanCtx) {
        new Chart(kepatuhanCtx, {
            type: 'doughnut',
            data: {
                labels: ['Selesai / Update', 'Dalam Proses', 'Belum Update'],
                datasets: [{
                    data: [CHART_DATA.completed, CHART_DATA.progress, CHART_DATA.pending],
                    backgroundColor: [
                        '#22c55e', // success (green)
                        '#eab308', // warning (yellow)
                        '#ef4444'  // danger (red)
                    ],
                    borderWidth: 0,
                    cutout: '75%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed + ' Item';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    }

    // Trend Line Chart
    const trendCtx = document.getElementById('trendChart');
    if (trendCtx) {
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV'],
                datasets: [{
                    label: 'Tingkat Kepatuhan',
                    data: CHART_DATA.trend,
                    borderColor: '#2563eb', // primary blue
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    borderWidth: 2,
                    pointBackgroundColor: '#2563eb',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + '%';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 100,
                        ticks: {
                            stepSize: 25,
                            callback: function(value) {
                                return value + '%';
                            }
                        },
                        grid: {
                            borderDash: [5, 5],
                            color: '#e2e8f0'
                        },
                        border: { display: false }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        border: { display: false }
                    }
                },
                layout: {
                    padding: {
                        top: 25
                    }
                }
            },
            plugins: [{
                id: 'customLineDatalabels',
                afterDatasetsDraw: function(chart, args, options) {
                    const ctx = chart.ctx;
                    chart.data.datasets.forEach((dataset, i) => {
                        const meta = chart.getDatasetMeta(i);
                        meta.data.forEach((point, index) => {
                            const data = dataset.data[index];
                            ctx.fillStyle = '#0F172A';
                            ctx.font = '600 11px "Poppins", sans-serif';
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';
                            ctx.fillText(data + '%', point.x, point.y - 12);
                        });
                    });
                }
            }]
        });
    }
});
