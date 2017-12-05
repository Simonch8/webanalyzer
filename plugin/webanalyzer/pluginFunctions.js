/**
*@author Simon Chiarot
*@version 1.0
*@date 05.12.2017
**/
function reloadLoadList()
{
	document.getElementById('adressList').innerHTML = "";
	chrome.storage.local.get(null, function(items) {
		var allKeys = Object.keys(items);
		for (var i = 0; i < allKeys.length; i++)
		{
			document.getElementById('adressList').innerHTML += '<option value="' + allKeys[i] + '">' + allKeys[i] + '</option>';
		}
	});
	toggleRemoveBtn();
}
function addAdress()
{
	var adress = document.getElementById('inptAdress').value;
	if (adress != "")
	{
		if (!adress.match(/^[a-zA-Z]+:\/\//))
		{
			adress = 'http://' + adress;
		}
		chrome.storage.local.set({[adress]: "1"});
		reloadLoadList();
		document.getElementById('inptAdress').value = "";
	}
}
function removeAdress()
{
	var adress = document.getElementById('adressList').value;
	if (adress != "")
	{
		chrome.storage.local.remove(adress);
		reloadLoadList();
	}
}
function toggleRemoveBtn()
{
	if (document.getElementById('adressList').value == "")
	{
		//Show remove button
		document.getElementById('btnRemove').style.display = "none";
	}
	else
	{
		//Hide remove button
		document.getElementById('btnRemove').style.display = "block";
	}
}
window.onload = function()
{
	document.getElementById('btnAdd').onclick = addAdress;
	document.getElementById("inptAdress").addEventListener("keyup", function(event)
	{
		event.preventDefault();
		if (event.keyCode === 13)
		{
			document.getElementById("btnAdd").click();
		}
	});
	document.getElementById('btnRemove').onclick = removeAdress;
	document.getElementById('adressList').onchange = toggleRemoveBtn;
	reloadLoadList();
};