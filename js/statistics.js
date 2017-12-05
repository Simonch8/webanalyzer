/**
* @author Raphael Hänni
* @version 2.0
* @date 5.12.2017
* @purpose create and update the charts
**/

//Global scope variables
var myChart;

//Excecutes when the window finished loading
$(window).ready( function() {
    var elem = $("#counter"),
        val = ( elem.val() >= 5 )? elem.val() : 5;

    //fills the first chart with the 10 most visited sites
    fillChart("statistic-1-canvas", "horizontalBar", val);

    //Change event for the input dom for the displayed pages
    $("#counter").on( 'change', function() {
        val = ( elem.val() >= 5 )? elem.val() : 5;
        if( val !== "" ) {
            fillChart("statistic-1-canvas", "horizontalBar", val);
        }
    });
});

/**
* get the data from the database via ajax
* @param id => id of the canvas as String (i.e. canvas-statistic-1)
* @param type => the type of the chart (i.e. horizontalBar or line)
* @param limit => limit as integer. Is taken from the userinput
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

/**
* creates a random colour
**/
function getRandomColour() {
    var letters = '0123456789ABCDEF'.split('');
    var colour = '#';
    for (var i = 0; i < 6; i++ ) {
        colour += letters[Math.floor(Math.random() * 16)];
    }
    return colour+"66";
}

/**
* creates an array of colours for the bars and lines in the charts
**/
function createColourArray( arr ) {
    var colours = new Array;
    $.each( arr, function() {
        colours.push( getRandomColour() );
    });
    return colours;
}

/**
* creates a new bar chart with the data from the methods above
* @param id_canvas  => id of the canvas as string. Inherited from fillChart()
* @param type       => type of the chart as string. Also inherited from fillChart()
* @param urls       => array with the names of the websites. Created in method fillChart()
* @param values     => array with the values for the names of the website. Created in method fillChart()
**/
function buildChart( id_canvas, type, urls, values ) {
    var id = document.getElementById(id_canvas),
        ctx = id.getContext('2d'),
        colours = createColourArray( urls );

    //empty the canvas before creating it from scratch
    if(window.myChart) {
        window.myChart.destroy();
    }

    //set height of the canvas dynamically
    id.height = urls.length * 20;

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
