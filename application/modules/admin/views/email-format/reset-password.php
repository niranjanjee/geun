
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>
<body style="padding:20px; font-family:verdana; font-size:11px;">

<div style="width:700px; border:1px solid #999; background-color:#effaff; padding-left:10px; font-family:Verdana, Geneva, sans-serif;">
	
   	<div style="margin-bottom:10px; margin-top:10px; padding-right:10px;">
    	        <td colspan="3" rowspan="3" align="left" valign="middle">
        <a href="http://ornamentopinion.com"><img src="http://ornamentopinion.com//assets/front/images/logo.png"></a>
        </td>
    </div>
    <div>
    	<div style="font-weight:bold;padding:5px 0 0 5px;">
        	Dear <?=$name;?>,
        </div>    
    </div>	    
    
    <div style="height:10px;"></div>
    
    <div style="font-family:Verdana, Geneva, sans-serif; font-size:12px; line-height:18px;padding:5px 0 0 5px;">
		To initiate the password reset process for your <?php echo $to;?> Gemstone Account.<br />click the link below:
	</div>
	
	<div style="height:10px;"></div>
	
	<div style="font-family:Verdana, Geneva, sans-serif; font-size:12px;padding:5px 0 0 5px;">
    	<a href="http://ornamentopinion.com/admin/createpassword/<?php echo $userid;?>"><?php echo $rndurl;?></a>
    </div>
	
	<div style="height:5px;"></div>
	
	<div style="font-family:Verdana, Geneva, sans-serif; font-size:12px; line-height:18px; padding:5px 0 0 5px;">
		If clicking the link above.
	</div>
	
	<div style="height:10px;"></div>
    
    <div style="font-family:Verdana, Geneva, sans-serif; font-size:12px; line-height:18px; padding:5px 0 0 5px;">
		If you've received this mail in error, it's likely that another user entered your email address by mistake while trying to reset a password. If you didn't initiate the request, you don't need to take any further action and can safely disregard this email.
	</div>
	
    <div style="height:10px;"></div>
	<div style="font-family:Verdana, Geneva, sans-serif; font-size:12px;padding:5px 0 0 5px;">Sincerely,</div>
	<div style="height:5px;"></div>
	<div style="font-family:Verdana, Geneva, sans-serif; font-size:12px;padding:5px 0 0 5px;">The Gemstone Team</div>
	<div style="height:5px;"></div>
		
</div>

</body>
</html>