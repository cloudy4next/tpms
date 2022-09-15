$(function ($) {
    'use strict';
    /*====  Line chart for home > chart page =====*/
    var chartLine1 = document.getElementById("lineChart2");
    var lineChart = new Chart(chartLine1, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "Charge Volume",
                fill: false,
                lineTension: 0.4,
                borderColor: '#00B9F1',
                backgroundColor: '#00B9F1',
                pointBorderColor: '#fff',
                pointBackgroundColor: '#00B9F1',
                pointRadius: 0,
                pointHoverRadius: 5,
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [100, 450, 500, 200, 550, 350, 1000],
            }]
        },
        options: {
            // showLines: false,
            scales: {
                yAxes: [{
                    ticks: {
                        // reverse: true,
                        beginAtZero: false,
                        legend: {
                            position: 'right',
                        }
                    }
                }]
            },
            responsive: true,
            animation: {
                animateScale: true
            }
        },
    });
    /*====  End line chart =====*/
    /*====  Start Bar chart > chart js =====*/
    var chartPageBar = document.getElementById("ChartPageBar");
    Chart.defaults.global.animation.duration = 800;
    var barChart = new Chart(chartPageBar, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March"],
            datasets: [{
                label: "CPT 1",
                fill: false,
                lineTension: 0.3,
                backgroundColor: "#00B9F1",
                borderColor: "#00B9F1",
                pointBorderColor: "#00B9F1",
                pointBackgroundColor: "#fff",
                pointHoverBackgroundColor: "#00B9F1",
                pointHoverBorderColor: "#00B9F1",
                data: [400, 320, 575, 400, 440, 140],
            },
                {
                    label: "CPT 2",
                    fill: false,
                    lineTension: 0.3,
                    backgroundColor: "#00cc99",
                    borderColor: "#00cc99",
                    pointBorderColor: "#00cc99",
                    pointBackgroundColor: "#fff",
                    pointHoverBackgroundColor: "#00cc99",
                    pointHoverBorderColor: "#00cc99",
                    data: [300, 280, 500, 650, 540, 280],
                },
                {
                    label: "CPT 3",
                    fill: false,
                    lineTension: 0.3,
                    backgroundColor: "#4186AF",
                    borderColor: "#4186AF",
                    pointBorderColor: "#4186AF",
                    pointBackgroundColor: "#fff",
                    pointHoverBackgroundColor: "#4186AF",
                    pointHoverBorderColor: "#4186AF",
                    data: [300, 500, 650, 540],
                },

            ]
        },
        options: {
            legend: {
                labels: {
                    usePointStyle: true
                }
            }
        }
    });
    var barChart2 = document.getElementById("barChart2");
    var barChart = new Chart(barChart2, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June"],
            datasets: [{
                label: "Denied",
                fill: false,
                lineTension: 0.3,
                backgroundColor: "#00B9F1",
                borderColor: "#00B9F1",
                pointBorderColor: "#00B9F1",
                pointBackgroundColor: "#fff",
                pointHoverBackgroundColor: "#00B9F1",
                pointHoverBorderColor: "#00B9F1",
                data: [400, 320, 575, 400, 440, 140],
            },
                {
                    label: "Overpaid",
                    fill: false,
                    lineTension: 0.3,
                    backgroundColor: "#00cc99",
                    borderColor: "#00cc99",
                    pointBorderColor: "#00cc99",
                    pointBackgroundColor: "#fff",
                    pointHoverBackgroundColor: "#00cc99",
                    pointHoverBorderColor: "#00cc99",
                    data: [300, 280, 500, 650, 540, 280],
                }
            ]
        },
        options: {
            legend: {
                labels: {
                    usePointStyle: true
                }
            }
        }
    });
});
