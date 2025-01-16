const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');

new Chart(revenueCtx, {
    type: 'pie',
    data: {
        labels: ['Company A', 'Company B', 'Company C', 'Company D', 'Company E'],
        datasets: [{
            label: 'Market Share',
            data: [30, 20, 15, 25, 10],
            backgroundColor: [
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0',
                '#9966FF'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                    }
                }
            }
        }
    }
});


new Chart(enrollmentCtx, {
    type: 'radar',
    data: {
        labels: ['Sales', 'Marketing', 'Development', 'Customer Support', 'HR', 'Finance'],
        datasets: [{
            label: 'Department Performance',
            data: [80, 85, 90, 70, 75, 80],
            backgroundColor: 'rgba(59, 130, 246, 0.2)',
            borderColor: '#3B82F6',
            pointBackgroundColor: '#3B82F6',
            pointBorderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        scales: {
            r: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(75, 85, 99, 0.2)'
                },
                angleLines: {
                    color: 'rgba(75, 85, 99, 0.2)'
                },
                ticks: {
                    color: '#9CA3AF'
                }
            }
        },
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});
