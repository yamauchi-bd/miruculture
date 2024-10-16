document.addEventListener('DOMContentLoaded', function() {
    // 既存の決定要因チャートの描画コード
    const decidingFactorsCtx = document.getElementById('decidingFactorsChart').getContext('2d');
    const decidingFactorsDataElement = document.getElementById('decidingFactorsData');
    const decidingFactorsData = JSON.parse(decidingFactorsDataElement.textContent);

    if (Object.keys(decidingFactorsData).length === 0) {
        // データが空の場合、グラフを描画しない
        return;
    }

    const gradientCyan1 = decidingFactorsCtx.createLinearGradient(0, 0, 0, 400);
    gradientCyan1.addColorStop(0, 'rgba(8, 145, 178, 1)');

    const gradientCyan2 = decidingFactorsCtx.createLinearGradient(0, 0, 0, 400);
    gradientCyan2.addColorStop(0, 'rgba(6, 182, 212, 1)');

    const gradientCyan3 = decidingFactorsCtx.createLinearGradient(0, 0, 0, 400);
    gradientCyan3.addColorStop(0, 'rgba(93, 217, 217, 1)');

    const chartOptions = {
        type: 'bar',
        data: {
            labels: decidingFactorsData.map(item => item.factor),
            datasets: [
                {
                    label: '1位',
                    data: decidingFactorsData.map(item => item.percentages[0]),
                    backgroundColor: gradientCyan1,
                },
                {
                    label: '2位',
                    data: decidingFactorsData.map(item => item.percentages[1]),
                    backgroundColor: gradientCyan2,
                },
                {
                    label: '3位',
                    data: decidingFactorsData.map(item => item.percentages[2]),
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
                            size: 11,
                            weight: 'bold'
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

    new Chart(decidingFactorsCtx, chartOptions);

    // 性格タイプ円グラフの描画
    const personalityTypesCtx = document.getElementById('personalityTypesChart');
    if (personalityTypesCtx) {
        const personalityTypeDataElement = document.getElementById('personalityTypeData');
        const personalityTypeData = JSON.parse(personalityTypeDataElement.textContent);

        if (personalityTypeData.length > 0) {
            // 性格タイプの順序を定義
            const typeOrder = [
                // 外交官
                'INFP', 'INFJ', 'ENFP', 'ENFJ',
                                // 番人
                'ISTJ', 'ISFJ', 'ESTJ', 'ESFJ',
                // 分析家
                'INTP', 'INTJ', 'ENTP', 'ENTJ',
                // 探検家
                'ISTP', 'ISFP', 'ESTP', 'ESFP'

            ];

            // データを順序に合わせてソートし、欠けているタイプを0で埋める
            const sortedData = typeOrder.map(type => {
                const found = personalityTypeData.find(item => item.type === type);
                return found ? found.count : 0;
            });

            // 性格タイプごとの色を定義（より薄い色）
            const colorMap = {
                'INFP': '#38a169', 'INFJ': '#2f855a', 'ENFP': '#48bb78', 'ENFJ': '#68d391',
                'INTP': '#6b46c1', 'INTJ': '#553c9a', 'ENTP': '#805ad5', 'ENTJ': '#9f7aea',
                'ISTP': '#d69e2e', 'ISFP': '#b7791f', 'ESTP': '#ecc94b', 'ESFP': '#f6e05e',
                'ISTJ': '#3182ce', 'ISFJ': '#2b6cb0', 'ESTJ': '#4299e1', 'ESFJ': '#63b3ed'
            };

            const colors = typeOrder.map(type => colorMap[type]);

            new Chart(personalityTypesCtx, {
                type: 'doughnut',
                data: {
                    labels: typeOrder,
                    datasets: [{
                        data: sortedData,
                        backgroundColor: colors,
                        borderColor: 'white',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                padding: 15,
                                font: {
                                    family: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                                    size: 10,
                                    weight: 'bold'
                                },
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value}名 (${percentage}%)`;
                                },
                                title: function() {
                                    return '';
                                }
                            }
                        }
                    },
                    layout: {
                        padding: {
                            bottom: 5  // 凡例のためのスペースを確保
                        }
                    },
                    cutout: '57%'  // 中央の空白
                }
            });
        }
    }
});
