<!DOCTYPE html>
<!--TheFreeElectron 2015, http://www.instructables.com/member/TheFreeElectron/ -->

<html>
    <head>
        <meta charset="utf-8" />
        <title>GPIO Controller</title>

        <style type="text/css" media="screen">
          * {
          margin: 0px 0px 0px 0px;
          padding: 0px 0px 0px 0px;
          }

          body, html {
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
          background-color: #ddd;

          font-family: Verdana, sans-serif;
          font-size: 11pt;
          text-align: center;
          }
          h1{
            padding-top: 40px;
            font-size: 36pt;
          }
          .content{
            background-color: #eee;
            width: 700px;
            margin: auto;
            min-height: 100vh;
          }
          .button{
            display: inline-block;
            width: 128px;
            margin: 20px;
          }
          .type_1{
            border: 5px rgba(0, 0, 0, 0.0) solid;
          }
          .type_1:active{
            border: 5px #999 solid;

          }
          .reboot{
            width: 100px;
            height: 100px;
            position: absolute;
            right: 200px;
            top: 20px;
          }
        </style>
    </head>

    <body>
      <div class="content">
    <!-- On/Off button's picture -->
	<?php
  $settings =  parse_ini_file ( "settings.ini" );
  $TOGGLE = 0;
  $MOMENTARY = 1;
  $CLOSED = 0;
  $OPEN = 1;
  $val_array = array(0,0,0,0,0,0,0,0);
	$type_array = array($TOGGLE, $TOGGLE,$MOMENTARY,$MOMENTARY,$MOMENTARY,$MOMENTARY,$MOMENTARY,$MOMENTARY);
  $initial_array = array(-1,-1,$OPEN,$OPEN,$OPEN,$OPEN,$OPEN,$OPEN);
	//this php script generate the first page in function of the file
  echo( "<h1>".$settings["title"]."</h1>");
	for ( $i= 0; $i< 8; $i++) {
		//set the pin's mode to output and read them
		// system("gpio mode ".$i." out");
    //set the initial state for momentaries
    if($initial_array[$i] > 0 ){ system("gpio write ".$i." ".$initial_array[$i] ); }
		exec ("gpio read ".$i, $val_array[$i], $return );
	}
	//for loop to read the value
	$i =0;
	for ($i = 3; $i < 8; $i++) {
		//if off
    echo ("<span class='button'>");
		if ($val_array[$i][0] == $CLOSED ) {
			echo ("<img id='button_".$i."' class='type_".$type_array[$i]."' src='data/img/red/red_".$i.".jpg' onclick='change_pin (".$i.", ".$type_array[$i].");'/>");
		}
		//if on
		if ($val_array[$i][0] == $OPEN ) {
			echo ("<img id='button_".$i."' class='type_".$type_array[$i]."' src='data/img/green/green_".$i.".jpg' onclick='change_pin (".$i.", ".$type_array[$i].");'/>");
		}
    echo ("</span>");
	}
	?>
</div>
	<!-- javascript -->
  <script src="script.js"></script>
    </body>
</html>
