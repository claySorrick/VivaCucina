<html>
<head>
<title>Aspectrics Instrument Network Configuration</title>
<?php

require 'function.php';

$NewIp = $_GET["IpChange"];
$NetMask = $_GET["NetMask"];
$CurrentIp = getCurrentNet(0); 
$CurrentSub = getCurrentNet(1); 
$Page = $_GET["Page"];
$Referrer = $_SERVER['HTTP_REFERER'];
$exec = FALSE;

$valip = validate_ip($NewIp);
$valnetmask = val_subnet($NetMask);
$valnetmask_alt = val_subnet_alt($NetMask);
$formpage = ereg("form.php", "$Referrer");

if($Page == "exec")
	$exec = TRUE;

if(($NewIp == "") && ($NetMask == ""))
	$clean = TRUE;

if(!$clean && $valip && $valnetmask && $valnetmask_alt && !$formpage && !$exec)
	echo("<meta http-equiv=\"REFRESH\" content=\"0;url=form.php?IpChange=$NewIp&NetMask=$NetMask\">");
?>
</head>
<body bgcolor="#FFFFFF">
<div align="center">
<?php include("header.htm");?>
<table border="0" align="center">
<tr>
<td align="right" width="50%">
<form action="index.php" method="get">
<b>Change Device I.P. To:</b>
<td>
<input type="text" name="IpChange" maxlength="15" value="<?php if(!$clean || $formpage || $exec ){ echo("$NewIp");} else {echo("$CurrentIp");}?>"/>
</td></td></tr>
<tr>
<td align="right">
<b>Change Subnet Mask To:</b>
<td>
<input type="text" name="NetMask" maxlength="15" value="<?php if(!$clean || $formpage || $exec ){ echo("$NetMask");} else {echo("$CurrentSub");}?>"/>
</td></td></tr>
</table><br />
<input type="reset" value="Reset"><input type="submit" value="Submit">
</form>
<?php

if($clean)
{
	echo("");
}
else
{
if(!$valip || !$valnetmask)
{	
	if((!$valip && !$valnetmask) || (!$valip && !$valnetmask_alt))
		echo("<b>IP and Subnet</b> are not valid, please try again");
	else
	{
		if(!$valip)
			echo("<b>IP</b> is not valid, please try again");
		if(!$valnetmask)
			echo("<b>Subnet</b> is not valid, please try again");
	}
} 
else 
{
	echo("Valid IP of <b>$NewIp</b> and Subnet of <b>$NetMask</b>.<br />");
}
}
?>
</div>
</body>
</html>