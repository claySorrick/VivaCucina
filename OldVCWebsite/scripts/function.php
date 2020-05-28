<?php

function validate_ip($ip){
$return = TRUE;

$eCheck = explode("e", $ip);
if(1 < sizeof($eCheck))
	return FALSE;

$xCheck = explode("x", $ip);
if(1 < sizeof($xCheck))
	return FALSE;

$hCheck = explode("h", $ip);
if(1 < sizeof($hCheck))
	return FALSE;

$tmp = explode(".", $ip);

if(4 != sizeof($tmp))
	return FALSE;

if(0 < $tmp[0] && $tmp[0] < 224)
{
	$comma = $tmp[0];
	if(is_numeric($comma))
	$returnA = TRUE;
	else
	$returnA = FALSE;
}
if(-1 < $tmp[1] && $tmp[1] < 256)
{
	$comma = $tmp[1];
	if(is_numeric($comma))
	$returnB = TRUE;
	else
	$returnB = FALSE;
}
if(-1 < $tmp[2] && $tmp[2] < 256)
{
	$comma = $tmp[2];
	if(is_numeric($comma))
	$returnC = TRUE;
	else
	$returnC = FALSE;
}
if(0 < $tmp[3] && $tmp[3] < 255)
{	
	$comma = $tmp[3];
	if(is_numeric($comma))
	$returnD = TRUE;
	else
	$returnD = FALSE;
}


if($return && $returnA && $returnB && $returnC && $returnD)
	return TRUE;
else
	return FALSE;
}

function val_subnet($subnet){
$number = array ( 0, 0, 0, 0, 0, 0, 0, 0 );
$change = 0;
$section = 1;
$zeroCheck = FALSE;
$return = TRUE;

$eCheck = explode("e", $subnet);
if(1 < sizeof($eCheck))
	return FALSE;

$xCheck = explode("x", $subnet);
if(1 < sizeof($xCheck))
	return FALSE;

$hCheck = explode("h", $subnet);
if(1 < sizeof($hCheck))
	return FALSE;


$tmp = explode(".", $subnet);

if(4 != sizeof($tmp))
{
	$return = FALSE;
}
else 
{
foreach($tmp AS $sub)
{
	if($sub == 255)
	{
		$return = TRUE;
	}
	else
	{
		$comma = $sub;
		$comma = is_numeric($comma);
		if(!$comma)
			return FALSE;
		if(999 < $sub)
			return FALSE;
		if($zeroCheck)
		{
			if($sub != 0)
				return FALSE;
		}
		else
		{
			if($sub < 0)
				return FALSE;
			for ($i=0; $i<8; $i++)
			{	
				$sub = $sub/2;
				if($sub % 2 == 0) 
				{
					$number[$i] = 2;
				}
				else
				{
					$number[$i] = 1;
				}
			}
			for ($i=1; $i<8; $i++)
			{	
				if($number[$i] != $number[$i-1])
				{
					$change++;
				}					
				if(2 < $change)
				{
					return FALSE;
				}
				if(($i == 7) && ($change < 3))
				{
					$zeroCheck = TRUE;
					if($section == 4)
						return TRUE;
				}
			}
			$change = 0;
		}
	}
	$section++;
}
}
return $return;
}

function val_subnet_alt($ip) {
if (!ip2long($ip)) {
	return false;
} 
elseif(strlen(decbin(ip2long($ip))) != 32 && ip2long($ip) != 0) 
{
	return false;
} 
elseif(ereg('01',decbin(ip2long($ip))) || !ereg('0',decbin(ip2long($ip)))) 
{
	return false;
} 
else 
{
	return true;
}
} 

function getCurrentNet($type){

$x = 0;
$go = false;

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

if($type == 0){
	if($sub === "Address.")
		$go = TRUE;
	if($valip && $go)
	{
		return $sub;
	}
}
if($type == 1){
	if($sub === "Subnet")
		$go = TRUE;
	if($valnetmask && $go)
	{
		return $sub;
	}
}
}
?>
