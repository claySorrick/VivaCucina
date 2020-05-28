<?php

require 'function.php';
$x = 0;

//$ipconfig = system('ipconfig');
//echo("$ipconfig");

$ipconfig = "
Windows IP Configuration


Ethernet adapter Local Area Connection:

        Media State . . . . . . . . . . . : Media disconnected

Ethernet adapter Local Area Connection 2:

        Connection-specific DNS Suffix  . : advancedphotometrics.com
        IP Address. . . . . . . . . . . . : 192.168.254.132
        Subnet Mask . . . . . . . . . . . : 255.255.255.0
        Default Gateway . . . . . . . . . : 192.168.254.100";

$tmp = explode(" ", $ipconfig);

foreach($tmp AS $sub)
{	
	$sub = trim($sub);
	$valip = validate_ip($sub);
	$valnetmask = val_subnet($sub);

	if($valip)
	{
		$ip[] = $sub;
		$x++;
	}
	if($valnetmask)
	{
		$ip[] = $sub;
		$x++;
	}
}
	for($i=0;$i<$x;$i++)
	{
		echo("$ip[$i]<br />");
	}
?> 