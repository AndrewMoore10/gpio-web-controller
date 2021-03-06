﻿//TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/
//JavaScript, uses pictures as buttons, sends and receives values to/from the Rpi
//These are all the buttons
var button_0 = document.getElementById("button_0");
var button_1 = document.getElementById("button_1");
var button_2 = document.getElementById("button_2");
var button_3 = document.getElementById("button_3");
var button_4 = document.getElementById("button_4");
var button_5 = document.getElementById("button_5");
var button_6 = document.getElementById("button_6");
var button_7 = document.getElementById("button_7");

//Create an array for easy access later
var Buttons = [ button_0, button_1, button_2, button_3, button_4, button_5, button_6, button_7];

//This function is asking for gpio.php, receiving datas and updating the index.php pictures
function reboot () {
	// alert("REBOOT");
	if(confirm("Are you sure you want to reboot? Transmitter will turn off while its rebooting.")){

		var request = new XMLHttpRequest();
		request.open( "GET" , "reboot.php" , true);
		request.send(null);

		request.onreadystatechange = function () {
			if (request.readyState == 4 && request.status == 200) {
			}
			//test if fail
			else if (request.readyState == 4 && request.status == 500) {
				alert ("Rebooting! Please wait");
				return ("fail");
			}
			//else
			else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) {
				alert ("Rebooting! Please wait");
				return ("fail");
			}
		}
	}
	return false;
}
function change_pin ( pic, type = 0 ) {
var data = 0;
//send the pic number to gpio.php for changes
//this is the http request
	var request = new XMLHttpRequest();
	url = "gpio.php?pic=";
	if(type == 1) url = "gpio_momentary.php?pic="
	request.open( "GET" , url + pic, true);
	request.send(null);
	//receiving informations
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			data = request.responseText;
			//update the index pic
			if ( !(data.localeCompare("0")) ){
				Buttons[pic].src = "data/img/red/red_"+pic+".jpg";
			}
			else if ( !(data.localeCompare("1")) ) {
				Buttons[pic].src = "data/img/green/green_"+pic+".jpg";
			}
			else if ( !(data.localeCompare("fail"))) {
				alert ("Something went wrong!" );
				return ("fail");
			}
			else {
				alert ("Something went wrong!" );
				return ("fail");
			}
		}
		//test if fail
		else if (request.readyState == 4 && request.status == 500) {
			alert ("server error");
			return ("fail");
		}
		//else
		else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) {
			alert ("Something went wrong!");
			return ("fail"); }
	}

return 0;
}
