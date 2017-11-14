var i = 1;

$("#addInput").click(function() {
    $("#inputs").append('<p><input class="form-control" type="url" name="url'+i+'" id="url'+i+'" /></p>');
    i++;
})