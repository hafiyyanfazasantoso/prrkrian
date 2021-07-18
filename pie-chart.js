let ctx = document.getElementById('pietercapaian').getContext('2d');
let labels = ['Tercapai', 'Belum Tercapai'];
let colorHex = ['#1492e6', '#faf056'];

let pietercapaian = new Chart(ctx, {
    type: 'pie',
    data: {
        datasets: [{
            data: [77, 23],
            backgroundColor: colorHex
        }],
        labels: labels
    },
    options: {
        responsive: true,
        legend: {
            position: 'bottom'
        },
        plugins: {
            datalabels: {
                color: '#fff',
                anchor: 'end',
                align: 'start',
                offset: -10,
                borderWidth: 2,
                borderColor: '#fff',
                borderRadius: 25,
                backgroundColor: (context) => {
                    return context.dataset.backgroundColor;
                },
                font: {
                    weight: 'bold',
                    size: '10'
                },
                formatter: (value) => {
                    return value + '%';
                }
            }
        }
    }
})