var myChart;

//Excecutes when the window finished loading
$(window).ready( function() {
    //fills the first chart with the 10 most visited sites
    fillChart("statistic-1-canvas", "horizontalBar", 10);

    //Change event for the input dom for the displayed pages
    $("#counter").on( 'change', function() {
        var elem = $("#counter"),
            val = elem.val();

        if( val !== "" ) {
            fillChart("statistic-1-canvas", "horizontalBar", val);
        }
    });
});

/**
* 
**/
function fillChart( id, type, limit) {
    var urls = new Array,
        values = new Array;

    $.ajax({
        type: "post",
        url: "php/getMostVisited.php",
    }).done( function( result ) {
        var data = JSON.parse(result);
        for( var i = 0; i < data.length; i++ ) {
            if( i < limit ) {
                urls.push(data[i]["url"]);
                values.push(data[i]["calls"]);
            }
        }

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
    return colours;
}

function buildChart( id_canvas, type, urls, values ) {
    var id = document.getElementById(id_canvas),
        ctx = id.getContext('2d'),
        colours = createColourArray( urls );

    //empty the canvas before adding it
    if(window.myChart) {
        window.myChart.destroy();
    }

    id.height = urls.length*20;

    myChart = new Chart(ctx, {
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
