<html>
<head>
<title>Aspectrics Instrument Network Configuration</title>
</head>
<body>
<center>
<?php

require 'function.php';

$NewIp = $_GET["IpChange"];
$NetMask = $_GET["NetMask"];
$HomePage = $_SERVER['HTTP_REFERER'];

$valip = validate_ip($NewIp);
$valnetmask = val_subnet($NetMask);
$valnetmask_alt = val_subnet_alt($NetMask);

include("header.htm");

if(!$valip || !$valnetmask)
{	
	if((!$valip && !$valnetmask) || (!$valip && !$valnetmask_alt))
		echo("<b>IP and Subnet</b> are not valid please go <a href=\"$HomePage\">Back</a> and try again");
	else
	{
		if(!$valip)
			echo("<b>IP</b> is not valid please go <a href=\"$HomePage\">Back</a> and try again");
		if(!$valnetmask || !$valnetmask_alt)
			echo("<b>Subnet</b> is not valid please go <a href=\"$HomePage\">Back</a> and try again");
	}
} 
else 
{		
	echo("
		<table border=\"0\"><tr><td align=\"right\" width=\"50%\"><b>New IP:</b></td><td>$NewIp</td></tr>
		<tr><td align=\"right\"><b>Subnet Mask:</b></td><td>$NetMask</td></tr></table>

		<center>Are you sure that this is ok?<br />
		 Some changes <b>cannot</b> be reversed.</center>
		
		<table border=\"0\"><tr><td align=\"right\" width=\"50%\"><FORM>
		<INPUT TYPE=\"BUTTON\" VALUE=\"Yes\" ONCLICK=\"window.location.href='exec.php?IpChange=$NewIp&NetMask=$NetMask'\"> 
		</FORM></td><td>
		<FORM>
		<INPUT TYPE=\"BUTTON\" VALUE=\"No\" ONCLICK=\"window.location.href='index.php'\"> 
		</FORM>
		</td></tr></table>
		");
}
?>
</center>
</body>
</html>