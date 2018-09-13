<!-- Check to make the request method we get back from the server is set to POST and 
	field that are filled are not empty -->
<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['action']))):

	// it is going to check for the POST superglobal with the value
	// if it does exist, then it will just create a new variable. 
	// And assign that value to that variable
	// So whatever the uses types in when they fill out the form originally 
	// and add it to the value of our inputs
	// meaning that when the form reloads it's going to remember everything
	if (isset($_POST['name'])) { 
		$clientName = strip_tags(trim($_POST['name'])); }
	if (isset($_POST['email'])) { 
		$clientEmail = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);}
	if (isset($_POST['subject'])) {	
		$clientSubject = strip_tags(trim($_POST['subject'])); }
	// here i am taking the variable $clientMessage
		//and running a filter sanitizing the string form the posted message, which will remove any HTML special characters
	if (isset($_POST['message'])) {
		$clientMessage = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING); } 
	
	//// i don't want to mail anything unless my form is error-free. So here i am creating a form error variable
	// and sent that to false
	$formerrors = false; 
	
	if (empty($clientName)):
		$err_name = '<div class="error"> Name is required</div>';
		//here variable is set to true if any validation or sanitization generates an error
		$formerrors = true; 
	endif; //input name field empty

	if (!preg_match("/^[a-zA-Z ]*$/",$clientName)):
		$err_name = '<div class="error">Letters and whitespace only</div>';
		$formerrors = true;
	endif; // pattern doesn't match for name field


	if (!preg_match('/^[^0-9][A-z0-9._%+-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/', $clientEmail)):
		$err_email = '<div class="error">Email is invalid</div>';
		$formerrors = true;
	endif;// pattern doesn't match for email field

	if (empty($clientEmail)):
		$err_email = '<div class="error">Email is required</div>';
		$formerrors = true;
	endif; //input email field empty

	if (empty($clientSubject)):
		$err_subject = '<div class="error">Subject is required </div>';
		$formerrors = true;
	endif; // input subject field empty

	if (empty($clientMessage)):
		$err_message = '<div class="error">Message is required </div>';
		$formerrors = true;
	endif; //input message field empty

	//here i am creating if statement that verifies that there are no errors
	// and place mail() function
	if (!($formerrors)):
		//Put your email address in here
		$to = "youemailaddress@gmail.com";
		//set the email subject, just put the title where the form is coming from 
		$subject = "From $clientEmail -- Contact Form ";
		// Set the message
		$message = "$clientName says\r\n $clientMessage";
		
		// issue the mail command
		// Just to remind PHP doesn't actually mail anything
	    // Mail is handled by your server's send mail command.
		if (mail($to, $subject, $message)):	
			$msg = "Thank You! Your message has been sent.";
			// The following code will empty the input field after form has be emailed
			$clientName = empty($clientName);
			$clientEmail = empty($clientEmail);
			$clientSubject = empty($clientSubject);
			$clientMessage = empty($clientMessage);

		else:
			$msg = "Oops! Something went wrong and message couldn't be sent.";
		endif; // mail form data


	endif; //check for form errors


endif; //form submitted

?>

