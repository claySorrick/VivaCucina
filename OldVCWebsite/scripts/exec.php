<html>
<head>
<title>Aspectrics Instrument Network Configuration</title>
<?php
require 'function.php';

$NewIp = $_GET["IpChange"];
$NetMask = $_GET["NetMask"];
$Referrer = $_SERVER['HTTP_REFERER'];

$valip = validate_ip($NewIp);
$valnetmask = val_subnet($NetMask);
$valnetmask_alt = val_subnet_alt($NetMask);
$NewIpCommand = "netsh interface ip set address name=\"Local Area Connection 2\" static $NewIp $NetMask";


if(!$valip || !$valnetmask)
{	
	echo("</head><body><center>");
	include("header.htm");
	if((!$valip && !$valnetmask) || (!$valip && !$valnetmask_alt))
		echo("<b>IP and Subnet</b> are not valid please go <a href=\"index.php?IpChange=$NewIp&NetMask=$NetMask\">Back</a> and try again");
	else
	{
		if(!$valip)
			echo("<b>IP</b> is not valid please go <a href=\"index.php?IpChange=$NewIp&NetMask=$NetMask\">Back</a> and try again");
		if(!$valnetmask)
			echo("<b>Subnet</b> is not valid please go <a href=\"index.php?IpChange=$NewIp&NetMask=$NetMask\">Back</a> and try again");
	}
} 
else 
{
//	echo("<meta http-equiv=\"REFRESH\" content=\"10;url=http://$NewIp/index.php?IpChange=$NewIp&NetMask=$NetMask&Page=exec\">");
	
	echo("</head><body>");
	include("header.htm");
	echo("<center>You will be redirected to the new IP in 10 Seconds, Please Wait.<br />");
	echo("If the redirection fails, please go <a href=\"index.php?IpChange=$NewIp&NetMask=$NetMask&Page=exec\">Back</a> and try again");

//	pclose(popen("start /b $NewIpCommand", 'r'));
}




?>
</center>
</body>
</html>