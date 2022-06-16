const ctx = document.getElementById('chart-bars').getContext('2d');

var ctx2 = document.getElementById("chart-lines").getContext('2d');



$.ajax({
    type: "GET",
    url: "/chart",
    success: function(response) {

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: 'Total Bills',
                    data: response,
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 5,
                    borderSkipped: false,
                    backgroundColor: "#fff",
                    maxBarThickness: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 15,
                            font: {
                                size: 14,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false
                        },
                        ticks: {
                            display: false
                        },
                    },
                },
            },
        });
    }
});





$.ajax({
    type: "GET",
    url: "/line/chart",
    success: function(response) {
        // console.log(response.waterBills);


        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(14,24,95,0.1)');
        gradientStroke1.addColorStop(0.2, 'rgba(14,24,95,0.1)');
        gradientStroke1.addColorStop(0, 'rgba(29,39,134,0)'); //purple colors


        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(29,185,195,0.6)');
        gradientStroke2.addColorStop(0.2, 'rgba(16,207,220,0.1)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors


        var gradientStroke3 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke3.addColorStop(1, 'rgba(47,164,255,0.1)');
        gradientStroke3.addColorStop(0.2, 'rgba(7,147,255,0.1)');
        gradientStroke3.addColorStop(0, 'rgba(65,173,255,0)'); //purple colors
        // ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']
        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                        label: "Electricity",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#0E185F",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: response.electricityBill,
                        maxBarThickness: 6

                    },
                    {
                        label: "Gas",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#1DB9C3",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: response.gasBill,
                        maxBarThickness: 6
                    },

                    {
                        label: "Water",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#2FA4FF",
                        borderWidth: 3,
                        backgroundColor: gradientStroke3,
                        fill: true,
                        data: response.waterBills,
                        maxBarThickness: 6
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    }
});