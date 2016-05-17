<?php
header("Content-type: text/html; charset=utf-8");
/**
 * This example shows making an SMTP connection with authentication.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require_once './lib//phpmailer/class.phpmailer.php';
require_once './lib//phpmailer/class.smtp.php';
require_once './lib//phpmailer/PHPMailerAutoload.php';

function sendemail($receivers, $subject, $contents) {

	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 2;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';

	//Set the hostname of the mail server
	$mail->Host = "smtp.163.com";
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = 25;

	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication
	$mail->Username = "boystyle_cn@163.com";
	//Password to use for SMTP authentication
	$mail->Password = "bscn163";
	//Set who the message is to be sent from
	$mail->setFrom('boystyle_cn@163.com', 'Boystyle.cn');

	//Set an alternative reply-to address
	// $mail->addReplyTo('replyto@example.com', 'First Last');

	//Set who the message is to be sent to
	$mail->addAddress($receivers);

	//Set the subject line
	$mail->Subject = $subject;

	// 使用内容模本发送邮件
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	// $mail->msgHTML(file_get_contents('./lib/PHPMailer/contents.html'), dirname(__FILE__));
	//Replace the plain text body with one created manually
	// $mail->AltBody = 'This is a plain-text message body';

	// $msg = "";
	// $msg .= "<html>";
	// $msg .= "<head>";
	// $msg .= "    <title>Boystyle.cn</title>";
	// $msg .= "</head>";
	// $msg .= "<body>";
	// $msg .= "    <h3>Boystyle.cn上线了</h3>";
	// $msg .= "    <p>终于可以开心个的买买买啦...</p>";
	// $msg .= "</body>";
	// $msg .= "</html>";
	// $mail->msgHTML($msg);

	$mail->msgHTML($contents);

	//附件
	//Attach an image file
	// $mail->addAttachment('images/phpmailer_mini.png');

	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
	}
}
