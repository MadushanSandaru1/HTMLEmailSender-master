<?php

	if(isset($_POST['submit'])){

		$email = $_POST['email'];
		$heading = $_POST['heading'];
		$message = $_POST['message'];
        
        require 'email/PHPMailerAutoload.php';
        $credential = include('email/credential.php');      //credentials import
        
        $mail = new PHPMailer;
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                             // Enable SMTP authentication
        $mail->Username = $credential['user'];              // SMTP username
        $mail->Password = $credential['pass'];              // SMTP password
        $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                  // TCP port to connect to
        $mail->setFrom($email);
        $mail->addAddress($email);                          // Name is optional

        $mail->addReplyTo('hello');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        
        //$mail->addAttachment('a.txt');                        // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        $mail->isHTML(true);                                    // Set email format to HTML
        
        $mail->Subject = $heading;
        $mail->Body    = $message;
        $mail->AltBody = 'If you see this mail. please reload the page.';
        
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "<script>alert('send your Email')</script>";
        }
    }

?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<title>Email Sender</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

	</head>

	<body>

		<div class="container">
			<h2>Email Sender</h2>

			<form action="index.php" method="post">

				<div class="form-group">
					<label for="email">To:</label>
					<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
				</div>

				<div class="form-group">
					<label for="pwd">Heading:</label>
					<input type="text" class="form-control" id="heading" placeholder="Enter heading" name="heading">
				</div>

				<div class="form-group">
					<label for="message">Message:</label>
					<textarea class="form-control" rows="5" id="message" name="message"></textarea>
				</div>

				<button type="submit" class="btn btn-primary" name="submit">Send</button>
			</form>
		</div>

	</body>

</html>
