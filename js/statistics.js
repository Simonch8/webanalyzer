$(window).ready( function() {
    fillChart("statistic-1-canvas", "horizontalBar");
});

function fillChart( id, type ) {
    var urls = new Array,
        values = new Array,
        first = true;
    console.log("fillChart");

    $.ajax({
        type: "post",
        url: "php/getMostVisited.php",
    }).done( function( result ) {
        var data = JSON.parse(result);
        $.each( data, function( key, value ) {
            urls.push(key);
            values.push(value);
            first = false;
        });

        buildChart( id, type, urls, values );
    });


}

function buildChart( id, type, urls, values ) {
    var ctx = document.getElementById(id).getContext('2d');

    var myChart = new Chart(ctx, {
        type: type,
        data: {
            labels: urls,
            datasets: [{
                label: 'Most Visited Sites',
                data: values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
}
