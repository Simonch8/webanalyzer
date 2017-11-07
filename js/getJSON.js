$(document).ready(function(){
    $.getJSON("http://webanalyzer.com/", function(result){
        $.each(result, function(i, field){
            $("div").append(field + " ");
        });
    });
});