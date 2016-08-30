#!/usr/bin/php
<?php

if (count($_SERVER['argv']) !== 2) {
	echo "Usage: ".$_SERVER['argv'][0]." <password>\n";
	exit -1;
}

$password = $_SERVER['argv'][1];
$saltArray = array("%SUC%", "*UDS*");
echo md5($saltArray[0].md5($password).$saltArray[1])."\n";

