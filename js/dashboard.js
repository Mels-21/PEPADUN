document.addEventListener("DOMContentLoaded", function() {
    const barCtx = document.getElementById('barChartCanvas');
    if (!barCtx) return;
    const ctx = barCtx.getContext('2d');
    
    let labels = ['Profil PPID', 'Regulasi', 'Laporan', 'Standar Layanan', 'Informasi Publik', 'Layanan Informasi', 'Keuangan', 'Pengelolaan Informasi'];
    let dataVals = [0, 0, 0, 0, 0, 0, 0, 0];

    if (typeof CHART_DATA !== 'undefined' && CHART_DATA.length > 0) {
        labels = CHART_DATA.map(item => item.category_name);
        dataVals = CHART_DATA.map(item => item.total);
    }
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Presentase Kepatuhan',
                data: dataVals,
                backgroundColor: '#0A4D9E',
                hoverBackgroundColor: '#3882F6',
                borderRadius: 2,
                barPercentage: 0.7,
                categoryPercentage: 0.8
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
                            return context.parsed.y + '%';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        stepSize: 20,
                        callback: function(value) {
                            return value + '%';
                        },
                        font: {
                            family: "'Poppins', sans-serif",
                            size: 11
                        },
                        color: '#64748B'
                    },
                    border: {
                        dash: [5, 5],
                        display: false
                    },
                    grid: {
                        color: '#E2E8F0',
                        tickBorderDash: [5, 5],
                        tickLength: 0
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif",
                            size: 11
                        },
                        color: '#64748B',
                        padding: 10
                    },
                    border: {
                        display: true,
                        color: '#E2E8F0'
                    }
                }
            },
            layout: {
                padding: {
                    top: 20
                }
            }
        },
        plugins: [{
            id: 'customDatalabels',
            afterDatasetsDraw: function(chart, args, options) {
                const ctx = chart.ctx;
                chart.data.datasets.forEach((dataset, i) => {
                    const meta = chart.getDatasetMeta(i);
                    meta.data.forEach((bar, index) => {
                        const data = dataset.data[index];
                        ctx.fillStyle = '#0F172A';
                        ctx.font = '500 11px "Poppins", sans-serif';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';
                        ctx.fillText(data + '%', bar.x, bar.y - 8);
                    });
                });
            }
        }]
    });
});
