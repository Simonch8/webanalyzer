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

function getRandomColour() {
    var letters = '0123456789ABCDEF'.split('');
    var colour = '#';
    for (var i = 0; i < 6; i++ ) {
        colour += letters[Math.floor(Math.random() * 16)];
    }
    return colour+"66";
}

function createColourArray( arr ) {
    var colours = new Array;
    $.each( arr, function() {
        colours.push( getRandomColour() );
    });
    console.log(colours);
    return colours;
}

function buildChart( id, type, urls, values ) {
    var id = document.getElementById(id),
        ctx = id.getContext('2d'),
        colours = createColourArray( urls );

    id.height = urls.length*20;


    var myChart = new Chart(ctx, {
        type: type,
        data: {
            labels: urls,
            datasets: [{
                label: 'Times Visited',
                data: values,
                backgroundColor: colours,
                borderColor: colours
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    position: 'top',
                    ticks: {
                        beginAtZero:true,
                        stepSize: 1
                    }
                }]
            }
        }
    });
}
