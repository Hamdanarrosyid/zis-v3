(function ($) {
    "use strict";
    const xhttp = new XMLHttpRequest()

    let jenis = []
    let saldo = []
    document.addEventListener('DOMContentLoaded', () => {
        xhttp.addEventListener('load', async () => {
            const data = await JSON.parse(xhttp.responseText)
            Object.keys(data).forEach(item => {
                jenis.push(item)
                saldo.push(data[item])
            })
        })
        xhttp.open("GET", "laporan/chart", true)
        xhttp.send()
    })
    console.log(saldo)
    const ctx = document.getElementById("chart");
    ctx.height = 100;
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: jenis,
            datasets: [
                {
                    label: "Grafik Laporan ZIS",
                    data: saldo,
                    borderColor:[
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(245, 189, 122, 1)',
                        'rgba(144, 152, 225, 1)',
                        'rgba(155, 226, 76, 1)',
                        'rgba(65, 222, 182, 1)',
                        'rgba(243,222, 245, 1)',
                        'rgba(145,149, 54, 1)',
                    ],
                    pointStyle: 'circle',
                    pointRadius: 5,
                    pointBorderColor: 'transparent',
                    pointBackgroundColor: 'rgba(0,200,155,0.60)',
                    borderWidth: "0",
                    backgroundColor:[
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(145, 189, 122, 0.2)',
                        'rgba(244, 152, 225, 0.2)',
                        'rgba(145, 226, 76, 0.2)',
                        'rgba(165, 222, 182, 0.2)',
                        'rgba(243,222, 245, 0.2)',
                        'rgba(145,149, 54, 0.2)',
                    ],
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        },

    });

    setTimeout(() => {
        myChart.update({
            easing: 'easeOutBounce'
        })
    },2000)

})(jQuery);
