/**
*@author Simon Chiarot
*@version 1.0
*@date 05.12.2017
**/
// Redirects Ajax calls to ensure, that https to http is possible
chrome.runtime.onMessage.addListener(function(request, sender, callback) {
  if (request.action == "xhttp") {

    $.ajax({
        type: request.method,
        url: request.url,
        data: request.data,
        success: function(data){
            callback(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            //if required, do some error handling
            callback();
        }
    });

    return true; // prevents the callback from being called too early on return
  }
});