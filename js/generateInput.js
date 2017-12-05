var i = 1;

$("#addInput").click(function() {
    $("#inputs").append('<p><input class="form-control" type="text"  pattern="[A-Za-z0-9\-*]+\.[a-z]{2,3}$" placeholder="z.B. google.ch" name="url'+i+'" id="url'+i+'" /></p>');
    i++;
})