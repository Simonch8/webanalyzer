/**
*@author Simon Chiarot
*@version 1.0
*@date 05.12.2017
**/
// Get the domain name of the current Website
var currentURL = window.location.hostname;

// Access browser storage of the plugin
chrome.storage.local.get(null, function(items) {
	// Get all Servers from storage and loop through it
	var allKeys = Object.keys(items);
	for (var i = 0; i < allKeys.length; i++)
	{
		// Send the current Website domain to the Server per ajax (redirected by background.js script)
		var adress = allKeys[i] + "/ajaxHandler.php";
		chrome.runtime.sendMessage({
			method: 'POST',
			action: 'xhttp',
			url: adress,
			data: "url=" + currentURL
		}, function(data) {
			// Ajax success function
			// Do nothing because no feedback for user required
		}); 
	}
});