google.charts.load('current', { 'packages': ['corechart', 'line'] });

google.charts.setOnLoadCallback(rendimientoVehiculo);

var url = new URL(window.location.href);

function rendimientoVehiculo() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'fecha');
    data.addColumn('number', 'Distancia (Km.)');
    data.addColumn('number', 'Combustible (Lts.)');

    request(function () {
        var response = JSON.parse(this.responseText);
        var parsedResponse = [];

        response.forEach(row => {
            parsedResponse.push([row.fecha, row.promedioKm, row.promedioCombustible]);
        });

        data.addRows(parsedResponse);

        var options = {
            hAxis: {
                title: 'Fecha Service'
            },
            vAxis: {
                title: 'Rendimiento'
            },
            legend: {
                position: 'top'
            },
            height: 500
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_vehiculo'));

        chart.draw(data, options);

    }, 'http://localhost/datos/vehiculoRendKm/?vehiculo=' + url.searchParams.get("vehiculo"));

}

function request(event, url) {
    const xhttp = new XMLHttpRequest();

    xhttp.onload = event;

    xhttp.open("GET", url);
    xhttp.send();
}