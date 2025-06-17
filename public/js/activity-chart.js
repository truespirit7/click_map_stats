async function fetchData() {
    const siteId = document.getElementById('siteId').dataset.siteId;

    const response = await fetch(`/api/sites/${siteId}/activity`);
    return await response.json();
}

async function createChart() {
    const apiData = await fetchData();

    // Подготовка данных - кол-во кликов в час
    const hours = Array.from({ length: 24 }, (_, i) => i);
    const counts = hours.map(hour => {
        const hourKey = hour.toString();
        return apiData[hourKey] ? apiData[hourKey].length : 0;
    });

    const labels = hours.map(h => `${h}:00`);

    const ctx = document.getElementById('activityChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Количество кликов',
                data: counts,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Количество кликов'
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Часы дня'
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Кликов: ${context.raw}`;
                        }
                    }
                }
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', createChart);