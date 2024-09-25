document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('decidingFactorsChart').getContext('2d');
    const dataElement = document.getElementById('decidingFactorsData');
    const data = JSON.parse(dataElement.textContent);

    if (Object.keys(data).length === 0) {
        // データが空の場合、グラフを描画しない
        return;
    }

    const gradientCyan1 = ctx.createLinearGradient(0, 0, 0, 400);
    gradientCyan1.addColorStop(0, 'rgba(8, 145, 178, 1)');

    const gradientCyan2 = ctx.createLinearGradient(0, 0, 0, 400);
    gradientCyan2.addColorStop(0, 'rgba(6, 182, 212, 1)');

    const gradientCyan3 = ctx.createLinearGradient(0, 0, 0, 400);
    gradientCyan3.addColorStop(0, 'rgba(93, 217, 217, 1)');

    const chartOptions = {
        type: 'bar',
        data: {
            labels: data.map(item => item.factor),
            datasets: [
                {
                    label: '1位',
                    data: data.map(item => item.percentages[0]),
                    backgroundColor: gradientCyan1,
                },
                {
                    label: '2位',
                    data: data.map(item => item.percentages[1]),
                    backgroundColor: gradientCyan2,
                },
                {
                    label: '3位',
                    data: data.map(item => item.percentages[2]),
                    backgroundColor: gradientCyan3,
                }
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            barThickness: 20, // バーの太さを調整
            scales: {
                x: {
                    stacked: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        },
                        font: {
                            family: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                            size: 10
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    stacked: true,
                    ticks: {
                        font: {
                            family: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                            size: 12
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            family: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: {
                        family: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                        size: 10
                    },
                    bodyFont: {
                        family: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                        size: 10
                    },
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.x !== null) {
                                label += context.parsed.x.toFixed(1) + '%';
                            }
                            return label;
                        },
                        afterBody: function(tooltipItems) {
                            let total = tooltipItems.reduce((sum, item) => sum + item.parsed.x, 0);
                        }
                    }
                }
            }
        }
    };

    // スマホサイズの時、y軸のフォントサイズを小さくし、グラフ間を狭める
    if (window.innerWidth <= 640) {
        chartOptions.options.scales.y.ticks.font.size = 10;
        chartOptions.options.barThickness = 10;
    }

    new Chart(ctx, chartOptions);
});