var currentURL = window.location.hostname;

chrome.storage.local.get(null, function(items) {
	var allKeys = Object.keys(items);
	for (var i = 0; i < allKeys.length; i++)
	{
		// Alle Serveradressen
		var adress = allKeys[i] + "/ajaxHandler.php";
		chrome.runtime.sendMessage({
			method: 'POST',
			action: 'xhttp',
			url: adress,
			data: "url=" + currentURL
		}, function(data) {
			
		}); 
	}
});