/**
* @author Jannis Viol
* @version 1.0
* @date 5.12.2017
* @purpose create new inputs for the blacklist
**/

var i = 1;

//Add another input field where a website can be entered to be blacklisted
$("#addInput").click(function() {
    $("#inputs").append('<p><input class="form-control" type="text"  pattern="[A-Za-z0-9\-*]+\.[a-z]{2,3}$" name="url'+i+'" id="url'+i+'" /></p>');
    i++;
});
