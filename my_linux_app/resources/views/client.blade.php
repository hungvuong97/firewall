<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel 5 | WebSockets</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-xs-12">
                <canvas id="barChart"></canvas>

                <br />
                <pre id="messages">
            </pre>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


    <script>
        //The homestead or local host server (don't forget the ws prefix)
        var input = document.getElementById('input');
        var messages = document.getElementById('messages');
        let index;
        let check;
        fetch('http://127.0.0.1:5001/es-search').then(res => res.json()).then(data => {
            let length = data.length;
            console.log(length)
            check = length
            if (length > 10) {
                index = 9;
            } else {
                index = length - 1
            }
            let i = 0
            while (i <= index) {
                var samp = document.createElement('samp');
                samp.innerHTML = '\n' + data[i]['_source']['@timestamp'] + ' ' + data[i]['_source']['msg'] + '\n';
                messages.appendChild(samp);
                i++;
            }
        })
        var print = function(message) {
            let length = message.length;
            console.log(index, length, check)
            if (check <= length) {
                while (index <= length) {

                    var samp = document.createElement('samp');
                    samp.innerHTML = '\n' + message[index]['_source']['@timestamp'] + ' ' + message[index]['_source']['msg'] + '\n';
                    messages.appendChild(samp);
                    index++;
                    var element = messages.getElementsByTagName('samp')[0];
                    messages.removeChild(element);
                }
                check = length;
            }
            return;
        };
        setInterval(() => {
            fetch('http://127.0.0.1:5001/es-search').then(res => res.json()).then(data => {
                print(data)
            })

        }, 2000);


        const getCassadra = () => {
            return new Promise((res, rej) => {
                fetch('http://127.0.0.1:5001/cassandra').then(res => res.json()).then(data => {
                    res(data)
                })
            })

        }
        var data = {
            labels: [],
            datasets: [{
                    label: "Motor",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(225,0,0,0.4)",
                    borderColor: "red", // The main line color
                    borderCapStyle: 'square',
                    borderDash: [], // try [5, 15] for instance
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "black",
                    pointBackgroundColor: "white",
                    pointBorderWidth: 1,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: "yellow",
                    pointHoverBorderColor: "brown",
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 10,
                    // notice the gap in the data and the spanGaps: true
                    data: [],
                    spanGaps: true,
                }, {
                    label: "Car",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(167,105,0,0.4)",
                    borderColor: "rgb(167, 105, 0)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "white",
                    pointBackgroundColor: "black",
                    pointBorderWidth: 1,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: "brown",
                    pointHoverBorderColor: "yellow",
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 10,
                    // notice the gap in the data and the spanGaps: false
                    data: [],
                    spanGaps: false,
                }

            ]
        };


        let count = 20;
        fetch('http://127.0.0.1:5001/cassandra').then(res => res.json()).then(val => {
            for (let i = 0; i < count; i++) {
                data.labels.push(val[i].timestamp)
                data.datasets[0].data.push(val[i].motor)
                data.datasets[1].data.push(val[i].car)
            }
            myBarChart.update()
        })

        run = async () => {
            let val = await getCassadra();
            console.log(val.length)
            // while (count <= val.length) {
            data.labels.push(val[count].timestamp)
            data.datasets[0].data.push(val[count].motor)
            data.datasets[1].data.push(val[count].car)
            data.labels.shift()
            data.datasets[0].data.shift()
            data.datasets[1].data.shift()
            myBarChart.update()
            count++
            // }
        }
        console.log(count)
        // run()
        setInterval(() => run(), 1000)


        var canvas = document.getElementById("barChart");
        var ctx = canvas.getContext('2d');

        // Global Options:
        Chart.defaults.global.defaultFontColor = 'black';
        Chart.defaults.global.defaultFontSize = 16;



        // Notice the scaleLabel at the same level as Ticks
        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Moola',
                        fontSize: 20
                    }
                }]
            }
        };

        // Chart declaration:
        var myBarChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    </script>
</body>

</html>