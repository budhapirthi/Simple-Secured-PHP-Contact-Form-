<?php include 'processform.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>PHP Contact form</title>
	<meta charset="UTF-8">
	<meta name="description" content="Contact form using HTML, PHP and CSS">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<!-- CSS 
	======================================================================  -->
	<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>
	
	<div class="contact-form-wrapper">
			
		<!-- if the msg variable is set, then it is going to print out the message
		from the process.php file to  the user -->
		<?php if (isset($msg)) {echo '<div id="formmessage"><p>', $msg , '</p></div>';} ?>	
		<!-- $_SERVER["PHP_SELF"] sends the submitted form data to the page itself, 
		instead of jumping to a different page. This way, 
		the user will get error messages on the same page as the form.
		Also htmlspecialchars is used to prevents attackers from exploiting 
		the code by injecting HTML or JavaScript code (Cross-site Scripting attacks) in forms    --> 			
		<form id="contact-form" name="myform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">

			<label>Name *</label><br/>
			<input type="text" name="name" placeholder="Please enter your full name" value="<?php if (isset($clientName)) {echo $clientName;} ?>"/>
			<?php if(isset($err_name)) {echo $err_name;}?>
			<br/>
			
			<!--if error_name variable exist echo the value of that variable on the screen -->
			<label>E-mail *</label><br/>
			<input type="text" name="email" placeholder="Please enter your valid email addess" value="<?php if (isset($clientEmail)) {echo $clientEmail;} ?>"/>
			<?php if(isset($err_email)) {echo $err_email;}?>
			<br/>
			
			<label>Subject *</label><br/>
			<input type="text" name="subject" placeholder="Please enter your subject" value="<?php if (isset($clientSubject)) {echo $clientSubject;} ?>"/>
			<?php if(isset($err_subject)) {echo $err_subject;}?>
			<br/>
			
			<label>Message *</label><br/>
			<textarea name="message" placeholder="Whats's on your mind"><?php if (isset($clientMessage)) {echo $clientMessage;} ?></textarea><?php if(isset($err_message)) {echo $err_message;}?>
			<br/>
			
			<input type="submit" name="action" class="send-mail-button" value="SEND MESSAGE">
		</form>
	</div> <!-- end contact-form-wrapper -->

</body>
</html>
