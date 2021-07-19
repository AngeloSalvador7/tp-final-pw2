google.charts.load('current', {'packages': ['corechart', 'bar']});

google.charts.setOnLoadCallback(estadoViajes);
google.charts.setOnLoadCallback(ganancias);

function ganancias() {
    var data = new google.visualization.DataTable();

    data.addColumn('string', 'Mes');
    data.addColumn('number', 'Ingresos');
    data.addColumn('number', 'Gastos');
    data.addColumn('number', 'Ganancias');

    request(function () {
        var response = JSON.parse(this.responseText);
        var parsedResponse = [];
        var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
            'Noviembre', 'Diciembre'];

        response.forEach(row => {
            parsedResponse.push(
                [
                    meses[row.mes - 1],
                    parseFloat(row.ingresos, 10),
                    parseFloat(row.gastos, 10),
                    parseFloat(row.ganancias, 10)
                ]);
        });

        data.addRows(parsedResponse);

        var options = {
            chart: {
                title: 'Ganancias de viajes',
                subtitle: 'Ingresos, Gastos, y Ganancias: 2021',
            },
            bars: 'vertical',
            vAxis: {format: 'decimal'},
            height: 350,
            colors: ['#1b9e77', '#d95f02', '#7570b3']
        };

        var chart = new google.charts.Bar(document.getElementById('chart_ganancias'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }, "http://localhost/datos/getGanancias");
    console.log(url);
}

function estadoViajes() {

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'estado');
    data.addColumn('number', 'cantidad');

    request(function () {
        var response = JSON.parse(this.responseText);
        var parsedResponse = [];

        response.forEach(row => {
            parsedResponse.push([row.estado, parseInt(row.cantidad, 10)]);
        });

        data.addRows(parsedResponse);

        var options = {
            'title': 'Porcentaje de viajes Segun su Estado',
            'titleTextStyle': {
                color: 'gray',
                bold: false
            },
            'width': 600,
            'height': 400
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }, "http://localhost/datos/getViajes");

}

function request(event, url) {
    const xhttp = new XMLHttpRequest();

    xhttp.onload = event;

    xhttp.open("GET", url);
    xhttp.send();
}